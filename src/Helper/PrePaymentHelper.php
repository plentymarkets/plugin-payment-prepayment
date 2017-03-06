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
