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

    /**
     * Load a specific setting for system client by plentyId
     *
     * @param $plentyId
     * @param string $name
     *
     * @return mixed|Settings
     * @throws ValidationException
     */
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
     * Get client settings by specific plentyId, indicating the array conversion
     *
     * @param $plentyId
     * @param bool $convertToArray
     *
     * @return array|Settings[]
     */
    public function getSettingsForPlentyId($plentyId, bool $convertToArray = true)
    {

        /** @var Settings $settings */
        $settings = $this->loadClientSettings($plentyId);

        if($convertToArray)
        {
            $outputArray = array();

            $availableSettings = Settings::AVAILABLE_SETTINGS;

            /** @var Settings $setting */
            foreach ($settings as $setting)
            {

                if (array_key_exists($setting->name, $availableSettings))
                {
                    $outputArray[$setting->name] = $setting->value;
                }

            }

            $outputArray['plentyId'] = $plentyId;

            $outputArray = $this->convertSettingsToCorrectFormat($outputArray,$availableSettings);

            return $outputArray;

        }

        return $settings;

    }

    /**
     * Update Settings
     *
     * @param $data
     *
     * @return int
     */
    public function saveSettings($data)
    {
        $pid = $data['plentyId'];
        unset( $data['plentyId']);

        if(count($data) > 0 && !empty($pid))
        {
            /** @var Settings[] $settings */
            $settings = $this->loadClientSettings($pid);

            /** @var Settings $setting */
            foreach ($settings as $setting)
            {
                if (array_key_exists($setting->name, $data))
                {
                    if (is_array($data[$setting->name]))
                    {
                        $data[$setting->name] = implode('-/', $data[$setting->name]);
                    }
                    $setting->value     = (string)$data[$setting->name];
                    $setting->updatedAt = date('Y-m-d H:i:s');

                    $this->db->save($setting);

                }
            }
            return 1;
        }

        return 0;
    }

    /**
     * Load settings for specified system clients by plentyId
     *
     * @param $plentyId
     *
     * @return \PrePayment\Models\Settings[]
     * @throws ValidationException
     */
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

    /**
     * Creates new settings for clients which are not in the DB but available in the system
     */
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

    /**
     * Creates new settings by plentyId
     *
     * @param $plentyId
     *
     * @return array
     */
    private function createSettingsForPlentyId($plentyId)
    {
        $generatedSettings    = array();

        foreach( Settings::AVAILABLE_SETTINGS as $setting => $type)
        {
            if($setting != 'plentyId')
            {
                /** @var Settings $newSetting */
                $newSetting            = pluginApp(Settings::class);
                $newSetting->plentyId  = $plentyId;
                $newSetting->name      = $setting;
                $newSetting->value     = (string)Settings::SETTINGS_DEFAULT_VALUES[$setting];
                $newSetting->updatedAt = date('Y-m-d H:i:s');

                $generatedSettings[] = $this->db->save($newSetting);
            }
        }

        return $generatedSettings;
    }

    /**
     * Get available clients of the system
     *
     * @return array
     */
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

    /**
     * Convert settings of type string to the correct format defined in Settings.php
     * NOTE: Array types only can be of 1 value type, e.g. float
     *
     * @param array $settings
     * @param array $format
     *
     * @return array
     */
    private function convertSettingsToCorrectFormat(array $settings, array $format)
    {
        $convertedSettings = array();
        foreach( $format as $setting => $type)
        {
            if(!is_array($type))
            {
                $convertedSettings[$setting] = $settings[$setting];
                $this->setType($convertedSettings[$setting], $type);
            }
            else
            {
                if($settings[$setting] != "")
                {
                    $settingArray = explode('-/', $settings[$setting]);
                    $arrayType    = array();
                    for($x = 0; $x < count($settingArray); $x++){ $arrayType[] = $type[0]; }
                    $convertedSettings[$setting] = $this->convertSettingsToCorrectFormat($settingArray, $arrayType);
                }
                else
                {
                    $convertedSettings[$setting] = array();
                }
            }

        }

        return $convertedSettings;
    }

    private function setType(&$value, $type)
    {
        switch($type)
        {
            case "boolean": return $value == 0 ? false : true;
            case "bool":    return $value == 0 ? false : true;
            case "integer": return number_format($value,0);
            case "int":     return number_format($value,0);
            case "float":   return number_format($value,4);
            case "string":  return (string)$value;
        }
    }

}