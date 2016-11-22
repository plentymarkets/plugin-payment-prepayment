<?php //strict

namespace PrePayment\Helper;

use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Modules\Payment\Method\Models\PaymentMethod;

class PrePaymentHelper
{

      /**
       * @var PaymentMethodRepositoryContract
       */
      private $paymentMethodRepository;

      /**
       * PrePaymentHelper constructor.
       *
       * @param PaymentMethodRepositoryContract $paymentMethodRepository
       */
      public function __construct(PaymentMethodRepositoryContract $paymentMethodRepository)
      {
            $this->paymentMethodRepository = $paymentMethodRepository;
      }

    /**
     * Create the ID of the payment method if it doesn't exist yet
     */
    public function createMopIfNotExists()
    {
        // Check whether the ID of the Invoice payment method has been created
        if($this->getPrePaymentMopId() == 'no_paymentmethod_found')
        {
            $paymentMethodData = array( 'pluginKey' => 'plenty_prepayment',
                                        'paymentKey' => 'PREPAYMENT',
                                        'name' => 'Vorkasse');

            $this->paymentMethodRepository->createPaymentMethod($paymentMethodData);
        }
    }

      /**
       * Get Prepayment Method of Payment ID
       *
       * @return mixed
       */
      public function getPrePaymentMopId()
      {
            //Load plenty_prepayment plugin data from DB
            $paymentMethods = $this->paymentMethodRepository->allForPlugin('plenty_prepayment');

            if( !is_null($paymentMethods) )
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
