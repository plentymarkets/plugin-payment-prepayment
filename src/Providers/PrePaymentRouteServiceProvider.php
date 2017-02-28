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
use Plenty\Plugin\Routing\ApiRouter;

class PrePaymentRouteServiceProvider extends RouteServiceProvider
{

    /**
     * @param Router $router
     */
    public function map(Router $router , ApiRouter $apiRouter)
    {
        $apiRouter->version(['v1'], ['namespace' => 'PayPal\Controllers', 'middleware' => 'oauth'],
            function (ApiRouter $apiRouter)
            {
                $apiRouter->get('payment/prepayment/settings/{plentyId}', 'PrePayment\Controllers\SettingsController@loadSettings');
                $apiRouter->put('payment/prepayment/settings', 'PrePayment\Controllers\SettingsController@saveSettings');
            });
        $router->get('payment/prepayment/settings/{plentyId}', 'PrePayment\Controllers\SettingsController@loadSettings');
        $router->put('payment/prepayment/settings', 'PrePayment\Controllers\SettingsController@saveSettings');
    }

}