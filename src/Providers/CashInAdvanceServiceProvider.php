<?php

namespace CashInAdvance\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodContainer;
use Plenty\Plugin\Templates\Twig;
use CashInAdvance\Extensions\CashInAdvanceTwigServiceProvider;
use CashInAdvance\Methods\CashInAdvancePaymentMethod;
use Plenty\Modules\Basket\Events\Basket\AfterBasketCreate;
use Plenty\Modules\Basket\Events\Basket\AfterBasketChanged;

/**
 * Class CashInAdvanceServiceProvider
 * @package CashInAdvance\Providers
 */
class CashInAdvanceServiceProvider extends ServiceProvider
{
    /**
    * Register the route service provider
    */
    public function register()
    {
        $this->getApplication()->register(CashInAdvanceRouteServiceProvider::class);
    }

    /**
    * @param PaymentMethodContainer    $payContainer
    */
    public function boot(Twig $twig, PaymentMethodContainer $payContainer)
    {
        $twig->addExtension(CashInAdvanceTwigServiceProvider::class);

        //Register the Pre Payment Plugin
        $payContainer->register('plenty::PREPAYMENT', CashInAdvancePaymentMethod::class,
                                [AfterBasketChanged::class, AfterBasketCreate::class]   );
    }
}
