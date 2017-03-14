<?php //strict

namespace PrePayment\Helper;

class PrePaymentHelper
{
    /**
     * Load the ID of the payment method
     * Return the ID for the payment method
     *
     * @return int
     */
    public function getPrePaymentMopId()
    {
        /**
         * Use the payment method id from the system
         */
        return 6000;
    }
}