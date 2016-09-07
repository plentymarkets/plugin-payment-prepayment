<?hh //strict

namespace PrePayment\Helper;

use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Modules\Payment\Contracts\PaymentRepositoryContract;
use Plenty\Modules\Payment\Method\Models\PaymentMethod;

class PrePaymentHelper
{
private PaymentMethodRepositoryContract $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryContract $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function createMopIfNotExists():void
    {
        if($this->getMop() == 'no_paymentmethod_found')
        {
            $paymentMethodData = array( 'pluginKey' => 'PrePayment',
                'paymentKey' => 'PREPAYMENT',
                'name' => 'PrePayment');

            $this->paymentMethodRepository->createPaymentMethod($paymentMethodData);
        }
    }

    public function getMop():mixed
    {
        $paymentMethods = $this->paymentMethodRepository->allForPlugin('PrePayment');

        if(count($paymentMethods))
        {
            foreach($paymentMethods as $paymentMethod)
            {
                if($paymentMethod->paymentKey == 'PREPAYMENT')
                {
                    return $paymentMethod->id;
                }
            }
        }

        return 'no_paymentmethod_found';
    }

}
