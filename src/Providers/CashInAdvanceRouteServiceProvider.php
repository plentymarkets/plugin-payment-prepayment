<?php

namespace CashInAdvance\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;
use Plenty\Plugin\Routing\ApiRouter;

class CashInAdvanceRouteServiceProvider extends RouteServiceProvider
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
                $routerApi->get('payment/cashinadvance/settings/{plentyId}/{lang}'         , ['uses' => 'CashInAdvance\Controllers\SettingsController@loadSettings']);
                $routerApi->put('payment/cashinadvance/settings'                           , ['uses' => 'CashInAdvance\Controllers\SettingsController@saveSettings']);
            });
       
       $router->get('payment/cashinadvance/bankdetails', 'CashInAdvance\Controllers\CashInAdvanceController@getBankDetails');
    }

}