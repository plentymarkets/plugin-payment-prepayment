<?php

namespace PrePayment\Methods;

use Plenty\Modules\Category\Contracts\CategoryRepositoryContract;
use Plenty\Modules\Frontend\Contracts\Checkout;
use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodService;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Plugin\Application;
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
    public function getName($lang = '')
    {
        if($lang == '')
        {
            /** @var FrontendSessionStorageFactoryContract $session */
            $session = pluginApp(FrontendSessionStorageFactoryContract::class);
            $lang = $session->getLocaleSettings()->language;
        }

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
        return 0.00;
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
            $icon = $app->getUrlPath('prepayment').'/images/icon.png';

            return $icon;
        }

        return '';
    }

    /**
     * Get PrepaymentSourceUrl
     *
     * @return string
     */
    public function getSourceUrl()
    {
        /** @var FrontendSessionStorageFactoryContract $session */
        $session = pluginApp(FrontendSessionStorageFactoryContract::class);
        $lang = $session->getLocaleSettings()->language;

        $infoPageType = $this->settings->getSetting('infoPageType',$lang);

        switch ($infoPageType)
        {
            case 1:
                // internal
                $categoryId = (int) $this->settings->getSetting('infoPageIntern', $lang);
                if($categoryId  > 0)
                {
                    /** @var CategoryRepositoryContract $categoryContract */
                    $categoryContract = pluginApp(CategoryRepositoryContract::class);
                    return $categoryContract->getUrl($categoryId, $lang);
                }
                return '';
            case 2:
                // external
                return $this->settings->getSetting('infoPageExtern', $lang);
            default:
                return '';
        }
    }

    /**
     * Get PrepaymentDescription
     *
     * @return string
     */
    public function getDescription( )
    {
        /** @var FrontendSessionStorageFactoryContract $session */
        $session = pluginApp(FrontendSessionStorageFactoryContract::class);
        $lang = $session->getLocaleSettings()->language;
        return $this->settings->getSetting('description', $lang);
    }

    /**
     * Check if it is allowed to switch to this payment method
     *
     * @return bool
     */
    public function isSwitchableTo()
    {
        return true;
    }

    /**
     * Check if it is allowed to switch from this payment method
     *
     * @return bool
     */
    public function isSwitchableFrom()
    {
        return true;
    }
}