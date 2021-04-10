<?php

namespace App\Http\Controllers\SMSGateway;

use \App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\AjaxRequestHelper;
use App\Http\Controllers\Helpers\AjaxResponse;
use App\Http\Controllers\Helpers\SenderHelper;
use \App\Http\Controllers\SMSGateway\Gateways;
use App\Models\Gatewayconfiguration;
use Illuminate\Http\Request;

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
            $gateways[] = array(
                'id' => $gatewayObject->getId(),
                'name' => $gatewayObject->getName(),
                'link' => $gatewayObject->getLink(),
                'configuration' => $gatewayObject->getConfiguration(),
                'configurationValues' => $this->getConfigurationValues($gatewayObject->getName())
            );
        }

        return $gateways;
    }

    private function getConfigurationValues($name)
    {
        $result = Gatewayconfiguration::where('name', $name)->first();

        if($result)
        {
            return unserialize($result->configuration);
        }
    }

    public function saveConfiguration($name, Request $request)
    {
        $configuration = AjaxRequestHelper::makeArray($request->get('configuration'));

        try {
            $gatewayConfModel = new Gatewayconfiguration();
            $gatewayConfModel->name = $name;
            $gatewayConfModel->configuration = serialize($configuration);
            $gatewayConfModel->createOrUpdate();

            return AjaxResponse::success($name . ' gateway has been updated.');
        }
        catch (\Throwable $exception) {
            return AjaxResponse::error('Update failed');
        }

    }

    public function testSend()
    {
        $helper = new SenderHelper();
        $helper->sendSMS(1, 'test');
    }


}
