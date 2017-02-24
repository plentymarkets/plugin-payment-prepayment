<?php
/**
 * Created by IntelliJ IDEA.
 * User: ckunze
 * Date: 23/2/17
 * Time: 12:22
 */

namespace PrePayment\Controllers;

use PrePayment\Services\SettingsService;
use Plenty\Plugin\Controller;
use Plenty\Plugin\Http\Request;
use Plenty\Plugin\Http\Response;

use Plenty\Repositories\Traits\GateProvider;

class SettingsController extends Controller
{

    public function loadSettings( Response $response, SettingsService $service)
    {
        return $response->json($service->loadSettings());
    }

    public function saveSettings(Request $request, Response $response, SettingsService $service)
    {
        return $response->json($service->saveSettings($request->except(['plentyMarkets'])));
    }

}