<?php

namespace PrePayment\Providers;

use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Modules\Basket\Models\Basket;
use Plenty\Plugin\ConfigRepository;
use Plenty\Plugin\Templates\Twig;
use PrePayment\Helper\PrePaymentHelper;

/**
 * Class PrePaymentOrderConfirmationDataProvider
 * @package PrePayment\Providers
 */
class PrePaymentOrderConfirmationDataProvider
{
    public function call(   Twig $twig,
                            ConfigRepository $configRepository,
                            BasketRepositoryContract $basketRepositoryContract,
                            PrePaymentHelper $prePaymentHelper,
                            $args)
    {
        /** @var Basket $basket */
        $basket = $basketRepositoryContract->load();

        $content = '';

        if($basket->methodOfPaymentId == 0)
        {
            if($configRepository->get('PrePayment.showBankData'))
            {
                $content .= $twig->render('PrePayment::BankDetails');
            }

            if($configRepository->get('PrePayment.showBookingText'))
            {
                $content .=  $twig->render('PrePayment::TransferReason', array());
            }
        }

        return $content;
    }
}