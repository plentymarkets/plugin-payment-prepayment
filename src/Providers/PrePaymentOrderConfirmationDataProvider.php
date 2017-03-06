<?php

namespace PrePayment\Providers;

use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Modules\Basket\Models\Basket;
use Plenty\Plugin\ConfigRepository;
use Plenty\Plugin\Templates\Twig;

use PrePayment\Helper\PrePaymentHelper;
use PrePayment\Services\SettingsService;
/**
 * Class PrePaymentOrderConfirmationDataProvider
 * @package PrePayment\Providers
 */
class PrePaymentOrderConfirmationDataProvider
{
    public function call(   Twig $twig,
                            SettingsService $settings,
                            BasketRepositoryContract $basketRepositoryContract,
                            PrePaymentHelper $prePaymentHelper,
                            $args)
    {
        /** @var Basket $basket */
        $basket = $basketRepositoryContract->load();

        $content = '';

        if($basket->methodOfPaymentId == 0)
        {
            if($settings->getSetting('showBankData'))
            {
                $content .= $twig->render('PrePayment::BankDetails');
            }

            if($settings->getSetting('showDesignatedUse'))
            {
                $content .=  $twig->render('PrePayment::DesignatedUse', array());
            }
        }

        return $content;
    }
}