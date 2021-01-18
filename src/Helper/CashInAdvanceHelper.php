<?php //strict

namespace CashInAdvance\Helper;

use Plenty\Modules\Helper\Services\WebstoreHelper;

class CashInAdvanceHelper
{
    /**
     * Load the ID of the payment method
     * Return the ID for the payment method
     *
     * @return int
     */
    public function getCashInAdvanceMopId()
    {
        /**
         * Use the payment method id from the system
         */
        return 6000;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        /** @var WebstoreHelper $webstoreHelper */
        $webstoreHelper = pluginApp(WebstoreHelper::class);

        /** @var \Plenty\Modules\System\Models\WebstoreConfiguration $webstoreConfig */
        $webstoreConfig = $webstoreHelper->getCurrentWebstoreConfiguration();

        $domain = $webstoreConfig->domainSsl;
        if (strpos($domain, 'master.plentymarkets') || $domain == 'http://dbmaster.plenty-showcase.de' || $domain == 'http://dbmaster-beta7.plentymarkets.eu' || $domain == 'http://dbmaster-stable7.plentymarkets.eu') {
            $domain = 'https://master.plentymarkets.com';
        }

        return $domain;
    }
}
