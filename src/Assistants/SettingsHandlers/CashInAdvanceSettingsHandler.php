<?php
namespace CashInAdvance\Assistants\SettingsHandlers;
use CashInAdvance\Services\SettingsService;
use Plenty\Modules\Plugin\Contracts\PluginLayoutContainerRepositoryContract;
use Plenty\Modules\System\Contracts\WebstoreRepositoryContract;
use Plenty\Modules\Wizard\Contracts\WizardSettingsHandler;

class CashInAdvanceSettingsHandler implements WizardSettingsHandler
{
    /**
     * @var Webstore
     */
    private $webstore;
    /**
     * @var Plugin
     */
    private $prePaymentPlugin;
    /**
     * @var Plugin
     */
    private $ceresPlugin;

    /**
     * @var Plugin
     */
    private $language;

    /**
     * @param array $parameter
     * @return bool
     */
    public function handle(array $parameter)
    {
        $data = $parameter['data'];
        $webstoreId = $data['config_name'];
        if(!is_numeric($webstoreId) || $webstoreId <= 0){
            $webstoreId = $this->getWebstore($parameter['optionId'])->storeIdentifier;
        }

        $this->savePrePaymentSettings($webstoreId, $data);
        $this->createContainer($webstoreId, $data);
        return true;
    }

    /**
     * @param int $webstoreId
     * @param array $data
     */
    private function savePrePaymentSettings($webstoreId, $data)
    {
        $settings = [
            'name' => '',
            'feeDomestic' => 0.00,
            'feeForeign' => 0.00,
            'showBankData' => $data['showBankData'] ?? '',
            'infoPageType' => $data['info_page_toggle'] ? ($data['info_page_type'] ?? 0) : 0,
            'infoPageIntern' => $data['info_page_toggle'] ? ($data['internal_info_page'] ?? '') : '',
            'infoPageExtern' => $data['info_page_toggle'] ? ($data['external_info_page'] ?? '') : '',
            'logo' => $data['logo_type_external'] ?? 0,
            'logoUrl' => $data['logo_url'] ?? '',
            'description' => '',
            'designatedUse' => $data['designatedUse'] ?? '',
            'showDesignatedUse' => $data['showDesignatedUse'] ?? 0,
            'plentyId' => $webstoreId,
            'shippingCountries' => $data['shippingCountries'] ?? [],
        ];
        /** @var SettingsService $settingsService */
        $settingsService = pluginApp(SettingsService::class);
        $settingsService->saveSettings($settings);
    }

    /**
     * @return string
     */
    private function getLanguage()
    {
        if ($this->language === null) {
            $this->language =  \Locale::getDefault();
        }

        return $this->language;
    }

    /**
     * @param int $webstoreId
     * @return Webstore
     */
    private function getWebstore($webstoreId)
    {
        if ($this->webstore === null) {
            /** @var WebstoreRepositoryContract $webstoreRepository */
            $webstoreRepository = pluginApp(WebstoreRepositoryContract::class);
            $this->webstore = $webstoreRepository->findByStoreIdentifier($webstoreId);
        }

        return $this->webstore;
    }

    /**
     * Check if a string is a valid UUID.
     *
     * @param string $string
     * @return false|int
     */
    public static function isValidUUIDv4($string)
    {
        $regex = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
        return preg_match($regex, $string);
    }

    /**
     * @param int $webstoreId
     * @return Plugin
     */
    private function getCeresPlugin($webstoreId)
    {
        if ($this->ceresPlugin === null) {
            $webstore = $this->getWebstore($webstoreId);
            $pluginSet = $webstore->pluginSet;
            $plugins = $pluginSet->plugins();
            $this->ceresPlugin = $plugins->where('name', 'Ceres')->first();
        }

        return $this->ceresPlugin;
    }

    /**
     * @param int $webstoreId
     * @return Plugin
     */
    private function getPrePaymentPlugin($webstoreId)
    {
        if ($this->prePaymentPlugin === null) {
            $webstore = $this->getWebstore($webstoreId);
            $pluginSet = $webstore->pluginSet;
            $plugins = $pluginSet->plugins();
            $this->prePaymentPlugin = $plugins->where('name', 'PrePayment')->first();
        }

        return $this->prePaymentPlugin;
    }

    /**
     * @param int $webstoreId
     * @param array $data
     */
    private function createContainer($webstoreId, $data)
    {
        $webstore = $this->getWebstore($webstoreId);
        $prePaymentPlugin = $this->getPrePaymentPlugin($webstoreId);
        $ceresPlugin = $this->getCeresPlugin($webstoreId);

        if( ($webstore && $webstore->pluginSetId) &&  $prePaymentPlugin !== null && $ceresPlugin !== null) {
            /** @var PluginLayoutContainerRepositoryContract $pluginLayoutContainerRepo */
            $pluginLayoutContainerRepo = pluginApp(PluginLayoutContainerRepositoryContract::class);

            $containerListEntries = [];

            // Default entries
            $containerListEntries[] = $this->createContainerDataListEntry(
                $webstoreId,
                'Ceres::MyAccount.OrderHistoryPaymentInformation',
                'CashInAdvance\Providers\CashInAdvanceOrderConfirmationDataProvider'
            );

            $containerListEntries[] = $this->createContainerDataListEntry(
                $webstoreId,
                'Ceres::OrderConfirmation.AdditionalPaymentInformation',
                'CashInAdvance\Providers\CashInAdvanceOrderConfirmationDataProvider'
            );

            if (isset($data['PaymentMethodIcon']) && $data['PaymentMethodIcon']) {
                $containerListEntries[] = $this->createContainerDataListEntry(
                    $webstoreId,
                    'Ceres::Homepage.PaymentMethods',
                    'CashInAdvance\Providers\Icon\IconProvider'
                );
            } else {
                $pluginLayoutContainerRepo->removeOne(
                    $webstore->pluginSetId,
                    'Ceres::Homepage.PaymentMethods',
                    'CashInAdvance\Providers\Icon\IconProvider',
                    $ceresPlugin->id,
                    $prePaymentPlugin->id
                );
            }

            $pluginLayoutContainerRepo->addNew($containerListEntries, $webstore->pluginSetId);
        }
    }

    /**
     * @param int $webstoreId
     * @param string $containerKey
     * @param string $dataProviderKey
     * @return array
     */
    private function createContainerDataListEntry($webstoreId, $containerKey, $dataProviderKey)
    {
        $webstore = $this->getWebstore($webstoreId);
        $prePaymentPlugin = $this->getPrePaymentPlugin($webstoreId);
        $ceresPlugin = $this->getCeresPlugin($webstoreId);

        $dataListEntry = [];

        $dataListEntry['containerKey'] = $containerKey;
        $dataListEntry['dataProviderKey'] = $dataProviderKey;
        $dataListEntry['dataProviderPluginId'] = $prePaymentPlugin->id;
        $dataListEntry['containerPluginId'] = $ceresPlugin->id;
        $dataListEntry['pluginSetId'] = $webstore->pluginSetId;
        $dataListEntry['dataProviderPluginSetEntryId'] = $prePaymentPlugin->pluginSetEntries[0]->id;
        $dataListEntry['containerPluginSetEntryId'] = $ceresPlugin->pluginSetEntries[0]->id;

        return $dataListEntry;
    }
}
