<?php

namespace PrePayment\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodContainer;
use Plenty\Plugin\Templates\Twig;
use PrePayment\Extensions\PrePaymentTwigServiceProvider;
use PrePayment\Methods\PrePaymentPaymentMethod;
use Plenty\Modules\Basket\Events\Basket\AfterBasketCreate;
use Plenty\Modules\Basket\Events\Basket\AfterBasketChanged;

/**
 * Class PrePaymentServiceProvider
 * @package PrePayment\Providers
 */
class PrePaymentServiceProvider extends ServiceProvider
{

    /**
    * Register the route service provider
    */
    public function register()
    {
      $this->getApplication()->register(PrePaymentRouteServiceProvider::class);
    }

    /**
    * @param PaymentMethodContainer    $payContainer
    */
    public function boot(Twig $twig, PaymentMethodContainer $payContainer)
    {
        $twig->addExtension(PrePaymentTwigServiceProvider::class);

        //Register the Pre Payment Plugin
        $payContainer->register('plenty_prepayment::PREPAYMENT', PrePaymentPaymentMethod::class,
                                [AfterBasketChanged::class, AfterBasketCreate::class]   );
    }
}
