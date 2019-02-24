<?php

namespace CashInAdvance\Migrations;

use CashInAdvance\Models\Settings;
use Plenty\Modules\Plugin\DataBase\Contracts\DataBase;
use CashInAdvance\Services\SettingsService;
use Plenty\Modules\Plugin\DataBase\Contracts\Migrate;
use CashInAdvance\Models\ShippingCountrySettings;

/** This migration initializes all Settings in the Database */
class CreateShippingCountrySettings_1_0
{
    use \Plenty\Plugin\Log\Loggable;

    /** @var  DataBase */
    private $db;

    public function __construct(DataBase $db)
    {
        $this->db = $db;
    }

    public function run(Migrate $migrate)
    {
        try {
            $migrate->createTable(ShippingCountrySettings::class);
            $this->migrateShippingCountries();
        } catch (\Exception $ex) {
            $this->getLogger(__CLASS__.'::'.__FUNCTION__)->error('CashInAdvance', $ex);
        }

    }

    private function migrateShippingCountries() {
        try {
            /** @var SettingsService $service */
            $service = pluginApp(SettingsService::class);
            $clients = $service->getClients();

            foreach ($clients as $plentyId) {
                /** @var Settings[] $storedShippingCountries */
                $storedShippingCountries = $this->db->query(Settings::MODEL_NAMESPACE)
                    ->where('plentyId', '=', $plentyId)
                    ->where('name', '=', 'shippingCountries')->get();

                $shippingCountriesString = '';
                foreach ($storedShippingCountries as $shippingCountriesRow){
                    $shippingCountriesString = $shippingCountriesRow->value;
                }
                $shippingCountriesArray = explode('-/-', $shippingCountriesString);
                foreach ($shippingCountriesArray as $shippingCountry) {
                    /** @var ShippingCountrySettings $shippingCountrySettings */
                    $shippingCountrySettings = pluginApp(ShippingCountrySettings::class);
                    $shippingCountrySettings->plentyId = $plentyId;
                    $shippingCountrySettings->shippingCountryId = $shippingCountry;
                    $this->db->save($shippingCountrySettings);
                }
            }
        } catch(\Exception $ex) {
            $this->getLogger(__CLASS__.'::'.__FUNCTION__)->error('CashInAdvance', $ex);
        }
    }

}