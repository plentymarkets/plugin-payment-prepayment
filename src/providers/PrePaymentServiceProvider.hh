<?hh // strict

namespace PrePayment\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodContainer;
use PrePayment\Methods\PrePaymentPaymentMethod;


/**
 * Class PrePaymentServiceProvider
 * @package PrePayment\Providers
 */
class PrePaymentServiceProvider extends ServiceProvider
{
    private PaymentMethodRepositoryContract $paymentMethodRepository;

    public function __construct(\Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract $mopRepository)
    {
        $this->paymentMethodRepository = $mopRepository;
    }

    /**
     * @param PaymentMethodContainer $mopContainer
     */
    public function boot(PaymentMethodContainer $mopContainer):void
    {
        $this->createMopIfNotExists();
        $mopContainer->register('PrePayment::prepayment', PrePaymentPaymentMethod::class, [\Plenty\Modules\Basket\Events\Basket\AfterBasketChanged::class]);
    }

    /**
     *
     */
    public function register():void
    {

    }

    /**
     *
     */
    public function createMopIfNotExists():void
    {
        if($this->getMop() == 'no_paymentmethod_found')
        {
            $paymentMethodData = array( 'pluginKey' => 'PrePayment',
                'paymentKey' => 'prepayment',
                'name' => 'Vorkasse');

            $this->paymentMethodRepository->createPaymentMethod($paymentMethodData);
        }
    }


    /**
     * @return mixed
     */
    public function getMop():mixed
    {
        $paymentMethods = $this->paymentMethodRepository->allForPlugin('PrePayment');

        if(count($paymentMethods))
        {
            return $paymentMethods[0]->id;
        }

        return 'no_paymentmethod_found';
    }

}
