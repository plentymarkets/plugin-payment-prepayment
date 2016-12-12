<?php

namespace PrePayment\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodContainer;
use PrePayment\Methods\PrePaymentPaymentMethod;
use PrePayment\Helper\PrePaymentHelper;
use Plenty\Modules\Basket\Events\Basket\AfterBasketCreate;
use Plenty\Modules\Basket\Events\Basket\AfterBasketChanged;
use \Plenty\Modules\Payment\Events\Checkout\GetPaymentMethodContent;
use Plenty\Modules\Payment\Events\Checkout\ExecutePayment;


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

      }

      /**
       * @param Dispatcher                $eventDispatcher
       * @param PrePaymentHelper          $prePaymentHelper
       * @param PaymentMethodContainer    $payContainer
       */
      public function boot(Dispatcher $eventDispatcher, PrePaymentHelper $prePaymentHelper, PaymentMethodContainer $payContainer)
      {
            //Register the Pre Payment Plugin
            $payContainer->register('plenty_prepayment::PREPAYMENT', PrePaymentPaymentMethod::class,
                                    [AfterBasketChanged::class, AfterBasketCreate::class]   );

            //Listen for the event to show bank data to the customer
            /*$eventDispatcher->listen(GetPaymentMethodContent::class,
                                      function(GetPaymentMethodContent $event) use( $prePaymentHelper)
                                      {
                                            if($event->getMop() == $prePaymentHelper->getPrePaymentMopId())
                                            {
                                                  //ToDo set Account Data to the container
                                                  $event->setValue('Dummy Account Data');
                                                  $event->setType( 'htmlContent');
                                            }

                                      }   );*/

            //Listen for the event which executes the payment
            $eventDispatcher->listen(ExecutePayment::class,
                    function(ExecutePayment $event) use( $prePaymentHelper)
                    {
                          if($event->getMop() == $prePaymentHelper->getPrePaymentMopId())
                          {
                                $event->setValue('<h1>Vorkasse<h1>');
                                $event->setType('htmlContent');
                          }
                    });

      }
}
