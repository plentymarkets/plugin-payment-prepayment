<?php

namespace PrePayment\Migrations;

use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use PrePayment\Helper\PrePaymentHelper;

/**
 * Migration to create payment mehtod
 *
 * Class CreatePaymentMethod
 * @package PrePayment\Migrations
 */
class CreatePaymentMethod
{
    /**
     * @var PaymentMethodRepositoryContract
     */
    private $paymentMethodRepositoryContract;

    /**
     * @var PrePaymentHelper
     */
    private $prePaymentHelper;

    /**
     * CreatePaymentMethod constructor.
     * @param PaymentMethodRepositoryContract $paymentMethodRepositoryContract
     * @param PrePaymentHelper $prePaymentHelper
     */
    public function __construct(PaymentMethodRepositoryContract $paymentMethodRepositoryContract, PrePaymentHelper $prePaymentHelper)
    {
        $this->paymentMethodRepositoryContract = $paymentMethodRepositoryContract;
        $this->prePaymentHelper = $prePaymentHelper;
    }

    /**
     * Run on plugin build
     *
     * Create Method of Payment ID for Prepayment if it doesn't exist
     */
    public function run()
    {
        /**
         * Check if the payment method exist
         */
        if($this->prePaymentHelper->getPrePaymentMopId() == 'no_paymentmethod_found')
        {
            $paymentMethodData = array( 'pluginKey'     => 'plenty_prepayment',
                                        'paymentKey'    => 'PREPAYMENT',
                                        'name'          => 'Vorkasse');

            //Call Payment Method Repository and Save data to DB
            $this->paymentMethodRepositoryContract->createPaymentMethod($paymentMethodData);
        }
    }
}