<?php
/**
 * Created by IntelliJ IDEA.
 * User: ckunze
 * Date: 23/2/17
 * Time: 12:26
 */

namespace PrePayment\Services;

use Illuminate\Database\Eloquent\Collection;
use Plenty\Exceptions\ValidationException;
use Plenty\Modules\Plugin\DataBase\Contracts\DataBase;
use Plenty\Modules\System\Contracts\WebstoreRepositoryContract;
use Plenty\Modules\System\Models\Webstore;
use Plenty\Plugin\Application;

use PrePayment\Models\Settings;


class SettingsService
{

    /** @var  DataBase */
    private $db;

    /** @var  array */
    private $loadedSettings;

    public function __construct(DataBase $db)
    {
        $this->db           = $db;
    }

    public function loadSetting($plentyId, string $name)
    {
        if(empty($loadedSettings))
        {
            $this->loadedSettings = $this->getSettingsForPlentyId($plentyId);
        }

        if(array_key_exists($name, $this->loadedSettings))
        {
            return $this->loadedSettings[$name];
        }

        throw new ValidationException('No such setting found!');
    }

    /**
     * @param bool $convertToArray
     *
     * @return array|Settings[]
     */
    public function getSettingsForPlentyId($plentyId, bool $convertToArray = true)
    {

        /** @var Settings $settings */
        $settings = $this->loadClientSettings($plentyId);

        $outputArray = array();

        $availableSettings = Settings::AVAILABLE_SETTINGS;

        if($convertToArray)
        {
            /** @var Settings $setting */
            foreach ($settings as $setting)
            {

                if (in_array($setting->name, $availableSettings))
                {
                    $outputArray[$setting->name] = $setting->value;
                }

            }
        }
        $outputArray['plentyId'] = $plentyId;

        return $outputArray;
    }


    public function saveSettings($data)
    {
        $pid               = $data['plentyId'];
        unset($data['plentyId']);

        /** @var Settings[] $settings */
        $settings = $this->loadClientSettings($pid);

        /** @var Settings $setting */
        foreach($settings as $setting)
        {
            if(array_key_exists($setting->name, $data))
            {

                $setting->value     = $data[$setting->name];
                $setting->updatedAt = date('Y-m-d H:i:s');

                $this->db->save($setting);

            }
        }

        return 1;
    }

    private function loadClientSettings($plentyId)
    {
        /** @var Settings[] $clientSettings */
        $clientSettings = $this->db->query('PrePayment\Models\Settings')
            ->where('plentyId', '=', $plentyId)->get();

        if( !count($clientSettings) > 0)
        {
            $this->updateClients();
            $clientSettings = $this->db->query('PrePayment\Models\Settings')
                                        ->where('plentyId', '=', $plentyId)->get();
        }

        if(!count($clientSettings) > 0)
        {
            throw new ValidationException('Error loading Settings');
        }

        return $clientSettings;
    }

    private function updateClients()
    {
        $clients = $this->getClients();

        foreach($clients as $plentyId)
        {
            /** @var Settings[] $query */
            $query = $this->db->query('PrePayment\Models\Settings')
                ->where('plentyId', '=', $plentyId );

            if( !count($query) > 0)
            {
                $this->createSettingsForPlentyId($plentyId);
            }
        }

    }

    private function createSettingsForPlentyId($plentyId)
    {
        $generatedSettings    = array();

        foreach( Settings::AVAILABLE_SETTINGS as $setting)
        {
            /** @var Settings $newSetting */
            $newSetting = pluginApp(Settings::class);
            $newSetting->plentyId = $plentyId;
            $newSetting->name = $setting;
            $newSetting->updatedAt = date('Y-m-d H:i:s');

            $generatedSettings[] = $this->db->save($newSetting);
        }

        return $generatedSettings;
    }


    private function getClients()
    {
        /** @var WebstoreRepositoryContract $wsRepo */
        $wsRepo = pluginApp(WebstoreRepositoryContract::class);

        $clients    = array();

        /** @var Webstore[] $result */
        $result = $wsRepo->loadAll();

        /** @var Webstore $record */
        foreach($result as $record)
        {

            $clients[] = $record->storeIdentifier;
        }

        return $clients;
    }

}