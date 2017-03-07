<?php

namespace PrePayment\Providers;

use Plenty\Plugin\Templates\Twig;

use PrePayment\Helper\PrePaymentHelper;
use PrePayment\Services\SessionStorageService;
use PrePayment\Services\SettingsService;
/**
 * Class PrePaymentOrderConfirmationDataProvider
 * @package PrePayment\Providers
 */
class PrePaymentOrderConfirmationDataProvider
{
    public function call(   Twig $twig, SettingsService $settings, PrePaymentHelper $prePaymentHelper,
                            SessionStorageService $service, $args)
    {
        $mop = $service->getOrderMopId();

        $content = '';

        if($mop == $prePaymentHelper->getPrePaymentMopId())
        {
            $lang = $service->getLang();
            if($settings->getSetting('showBankData', $lang))
            {
                $content .= $twig->render('PrePayment::BankDetails');
            }

            if($settings->getSetting('showDesignatedUse', $lang))
            {
                $content .=  $twig->render('PrePayment::DesignatedUse', array());
            }
        }

        return $content;
    }
}