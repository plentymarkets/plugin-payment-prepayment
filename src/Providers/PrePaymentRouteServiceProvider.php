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
       $apiRouter->version(['v1'], ['middleware' => ['oauth']],
            function ($routerApi)
            {
                /** @var ApiRouter $routerApi*/
                $routerApi->get('payment/prepayment/settings/{plentyId}/{lang}'         , ['uses' => 'PrePayment\Controllers\SettingsController@loadSettings']);
                $routerApi->put('payment/prepayment/settings'                           , ['uses' => 'PrePayment\Controllers\SettingsController@saveSettings']);
            });
    }

}