<?php

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