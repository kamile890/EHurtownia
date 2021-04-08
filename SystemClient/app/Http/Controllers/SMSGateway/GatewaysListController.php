<?php

namespace App\Http\Controllers\SMSGateway;

use \App\Http\Controllers\Controller;
use \App\Http\Controllers\SMSGateway\Gateways;

class GatewaysListController extends Controller
{

    public function index()
    {

        $gatewayList = $this->getGateways();

        return view('SMSGateways/gatewaysList', compact('gatewayList'));
    }

    private function getGateways()
    {
        $gateways = [];

        $dir = '../app/Http/Controllers/SMSGateway/Gateways';
        $files = array_diff(scandir($dir), array('.', '..'));

        foreach($files as $file)
        {
            $class = '\\App\\Http\\Controllers\\SMSGateway\\Gateways\\' . explode('.', $file)[0];
            $gatewayObject = new $class();
            $gateways[] = array('name' => $gatewayObject->getName(), 'link' => $gatewayObject->getLink());
        }

        return $gateways;
    }

}
