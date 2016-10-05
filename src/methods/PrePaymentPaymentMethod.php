<?php 

namespace PrePayment\Methods;

use Plenty\Modules\Payment\Method\Contracts\PaymentMethodService;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Plugin\ConfigRepository;

/**
 * Class PrePaymentPaymentMethod
 * @package PrePayment\Methods
 */
class PrePaymentPaymentMethod extends PaymentMethodService
{

      /**
       * @var BasketRepositoryContract
       */
      private $basketRepo;


      /**
       * @var ConfigRepository
       */
      private $configRepo;

      /**
       * PrePaymentPaymentMethod constructor.
       * @param BasketRepositoryContract $basketRepo
       * @param ConfigRepository $configRepo
       */
      public function __construct(BasketRepositoryContract    $basketRepo,
                                  ConfigRepository            $configRepo)
      {
            $this->basketRepo     = $basketRepo;
            $this->configRepo     = $configRepo;
      }

      /**
       * Check whether Prepayment is active or not
       *
       * @return bool
       */
      public function isActive()
      {
            return true;
      }


      /**
       * Get Prepayment Fee
       *
       * @return float
       */
      public function getFee()
      {
            $basket = $this->basketRepo->load();

            // Shipping Country ID with ID = 1 belongs to Germany
            if($basket->shippingCountryId == 1)
            {
                  return $this->configRepo->get('PrePayment.fee.domestic');
            }
            else
            {
                  return $this->configRepo->get('PrePayment.fee.foreign');
            }

      }


      /**
       * Get Prepayment Icon
       *
       * @return string
       */
      public function getIcon( ConfigRepository $config )
      {
            if($config->get('PrePayment.logo') == 1)
            {
                  return $this->configRepo->get('Prepayment.logo.url');
            }

            return '';
      }


      /**
       * Get PrepaymentDescription
       *
       * @param ConfigRepository $config
       * @return string
       */
      public function getDescription( ConfigRepository $config )
      {
            switch($this->configRepo->get('PrePayment.infoPage.type'))
            {
                  case 1: return $this->configRepo->get('PrePayment.infoPage.extern'); break;
                  case 2: return $this->configRepo->get('PrePayment.infoPage.intern'); break;
                  default: return ''; break;
            }
      }


}