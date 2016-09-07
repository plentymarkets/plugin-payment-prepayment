<?hh // strict

namespace PrePayment\Services;

use Plenty\Modules\Payment\Method\Contracts\PaymentMethodService;
use Plenty\Plugin\ServiceProvider;
use Plenty\Modules\Payment\Method\PaymentMethodServiceProvider;

class PrePaymentPaymentService
{
    public function isActive():bool
    {
        //check if active


        return true;
    }
}