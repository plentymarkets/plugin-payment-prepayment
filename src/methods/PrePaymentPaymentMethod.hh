<?hh // strict

namespace PrePayment\Methods;

use Plenty\Modules\Payment\Method\Contracts\PaymentMethodService;

/**
 * Class PrePaymentPaymentMethod
 * @package PrePayment\Methods
 */
class PrePaymentPaymentMethod extends PaymentMethodService
{
    /**
     * @return bool
     */
    public function isActive():bool
    {
        return true;
    }
}