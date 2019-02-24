<?php

namespace CashInAdvance\Migrations;

use Plenty\Modules\Plugin\DataBase\Contracts\Migrate;
use CashInAdvance\Models\ShippingCountrySettings;

/** This migration initializes all Settings in the Database */
class CreateShippingCountrySettings_1_0
{
    use \Plenty\Plugin\Log\Loggable;

    public function run(Migrate $migrate)
    {
        try
        {
            $migrate->createTable(ShippingCountrySettings::class);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }

    }

}