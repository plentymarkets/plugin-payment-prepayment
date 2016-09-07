<?hh // strict

namespace PrePayment\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodContainer;
use PrePayment\Methods\PrePaymentPaymentMethod;
use PrePayment\Helper\PrePaymentHelper;


/**
 * Class PrePaymentServiceProvider
 * @package PrePayment\Providers
 */
class PrePaymentServiceProvider extends ServiceProvider
{
    public function register():void
    {

    }

    public function boot(PrePaymentHelper $paymentHelper,
                         PaymentMethodContainer $payContainer):void
    {
        $paymentHelper->createMopIfNotExists();

        $payContainer->register('PrePayment::PREPAYMENT', PrePaymentPaymentMethod::class,
            [\Plenty\Modules\Basket\Events\Basket\AfterBasketChanged::class,
                \Plenty\Modules\Basket\Events\Basket\AfterBasketCreate::class]);

    }
}
