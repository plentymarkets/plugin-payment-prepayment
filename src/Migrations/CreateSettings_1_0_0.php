<?php
/**
 * Created by IntelliJ IDEA.
 * User: ckunze
 * Date: 23/2/17
 * Time: 15:54
 */

namespace PrePayment\Migrations;

use Plenty\Modules\Plugin\DataBase\Contracts\Migrate;
use Plenty\Modules\Plugin\DataBase\Contracts\DataBase;
use Plenty\Modules\System\Contracts\WebstoreRepositoryContract;

use Plenty\Modules\System\Models\Webstore;
use PrePayment\Models\Settings;

class CreateSettings_1_0_0
{

    public function run(Migrate $migrate, DataBase $db)
    {
        $migrate->createTable(Settings::class);



        $this->setInitialSettings($db);
    }

    private function setInitialSettings(DataBase $db)
    {
        foreach($this->getClients() as $plentyId)
        {
            foreach (Settings::AVAILABLE_SETTINGS as $setting)
            {
                /** @var Settings $newSetting */
                $newSetting            = pluginApp(Settings::class);
                $newSetting->plentyId  = $plentyId;
                $newSetting->name      = $setting;
                $newSetting->updatedAt = date('Y-m-d H:i:s');

                $db->save($newSetting);
            }
        }
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