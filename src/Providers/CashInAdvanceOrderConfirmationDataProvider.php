<?php

namespace CashInAdvance\Providers;

use Plenty\Plugin\Templates\Twig;

use CashInAdvance\Helper\CashInAdvanceHelper;
use CashInAdvance\Services\SessionStorageService;
use CashInAdvance\Services\SettingsService;
/**
 * Class CashInAdvanceOrderConfirmationDataProvider
 * @package CashInAdvance\Providers
 */
class CashInAdvanceOrderConfirmationDataProvider
{
    /**
     * @param Twig $twig
     * @param SettingsService $settings
     * @param CashInAdvanceHelper $cashInAdvanceHelper
     * @param SessionStorageService $service
     * @param array $args
     * @return string
     */
    public function call(   Twig $twig,
                            SettingsService $settings,
                            CashInAdvanceHelper $cashInAdvanceHelper,
                            SessionStorageService $service,
                            $arg)
    {
        $mop = $service->getOrderMopId();

        $content = '';

        if($mop == $cashInAdvanceHelper->getCashInAdvanceMopId())
        {
            $lang = $service->getLang();
            if($settings->getSetting('showBankData', $lang))
            {
                $content .= $twig->render('CashInAdvance::BankDetails');
            }

            if($settings->getSetting('showDesignatedUse', $lang))
            {
                $content .=  $twig->render('CashInAdvance::DesignatedUse', ['order'=>$arg[0]]);
            }
        }

        return $content;
    }
}