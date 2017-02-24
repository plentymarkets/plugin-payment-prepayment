<?php
/**
 * Created by IntelliJ IDEA.
 * User: ckunze
 * Date: 23/2/17
 * Time: 15:48
 */

namespace PrePayment\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

class PrePaymentRouteServiceProvider extends RouteServiceProvider
{

    /**
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->get('payment/prepayment/settings', 'PrePayment\Controllers\SettingsController@loadSettings');
        $router->put('payment/prepayment/settings', 'PrePayment\Controllers\SettingsController@saveSettings');
    }

}