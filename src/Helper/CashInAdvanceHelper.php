<?php //strict

namespace CashInAdvance\Helper;

class CashInAdvanceHelper
{
    /**
     * Load the ID of the payment method
     * Return the ID for the payment method
     *
     * @return int
     */
    public function getCashInAdvanceMopId()
    {
        /**
         * Use the payment method id from the system
         */
        return 6000;
    }
}