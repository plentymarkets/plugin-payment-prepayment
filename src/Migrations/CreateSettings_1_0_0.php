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
        foreach( Settings::AVAILABLE_SETTINGS as $setting)
        {
            /** @var Settings $newSetting */
            $newSetting = pluginApp(Settings::class);
            $newSetting->name = $setting;
            $newSetting->updatedAt = date('Y-m-d H:i:s');

            $db->save($newSetting);
        }

    }


}