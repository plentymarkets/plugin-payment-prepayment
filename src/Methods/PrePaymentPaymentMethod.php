<?php 

namespace PrePayment\Methods;

use Plenty\Modules\Frontend\Contracts\Checkout;
use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodService;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use PrePayment\Services\SettingsService;

/**
 * Class PrePaymentPaymentMethod
 * @package PrePayment\Methods
 */
class PrePaymentPaymentMethod extends PaymentMethodService
{
    /** @var BasketRepositoryContract */
    private $basketRepo;

    /** @var  SettingsService */
    private $settings;

    /** @var  Checkout */
    private $checkout;

    /**
    * PrePaymentPaymentMethod constructor.
    * @param BasketRepositoryContract   $basketRepo
    * @param SettingsService            $service
    * @param Checkout                   $checkout
    */
    public function __construct(  BasketRepositoryContract    $basketRepo,
                                  SettingsService             $service,
                                  Checkout $checkout)
    {
        $this->basketRepo     = $basketRepo;
        $this->settings       = $service;
        $this->checkout       = $checkout;
    }

    /**
    * Check whether Prepayment is active or not
    *
    * @return bool
    */
    public function isActive()
    {
        if(!in_array($this->checkout->getShippingCountryId(), $this->settings->getSetting('shippingCountries')))
        {
            return false;
        }

        return true;
    }

    /**
    * Get shown name
    *
    * @return string
    */
    public function getName()
    {
        /** @var FrontendSessionStorageFactoryContract $session */
        $session = pluginApp(FrontendSessionStorageFactoryContract::class);
        $lang = $session->getLocaleSettings()->language;

        if(!empty($lang))
        {
            $name = $this->settings->getSetting('name', $lang);
        }
        else
        {
            $name = $this->settings->getSetting('name');
        }

        return $name;
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
              return $this->settings->getSetting('feeDomestic');
        }
        else
        {
              return $this->settings->getSetting('feeForeign');
        }
    }

    /**
    * Get Prepayment Icon
    *
    * @return string
    */
    public function getIcon( )
    {
        if( $this->settings->getSetting('logo') == 1)
        {
              return $this->settings->getSetting('logoUrl');
        }
        elseif($this->settings->getSetting('logo') == 2)
        {
            $app = pluginApp(Application::class);
                $icon = $app->getUrlPath('prepayment').'/images/logos/de-pp-logo.png';

                return $icon;
        }

        return '';
    }

    /**
    * Get PrepaymentDescription
    *
    * @return string
    */
    public function getDescription( )
    {
        switch($this->settings->getSetting('infoPageType'))
        {
              case 1:
                    return $this->settings->getSetting('infoPageExtern');
                    break;

              case 2:
                    return $this->settings->getSetting('infoPageIntern');
                    break;

              default:
                    return '';
                    break;
        }
    }
}