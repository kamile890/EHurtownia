<?php

namespace App\Http\Controllers\SMSGateway;

use \App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\AjaxRequestHelper;
use App\Http\Controllers\Helpers\AjaxResponse;
use App\Http\Controllers\Helpers\HttpRequestHelper;
use App\Http\Controllers\Helpers\HttpResponse;
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

    public function saveConfiguration(Request $request)
    {

        $params = HttpRequestHelper::getArray($request->all());
        unset($params['gatewayName']);

        try {
            $gatewayConfModel = new Gatewayconfiguration();
            $gatewayConfModel->name = $request->all()['gatewayName'];
            $gatewayConfModel->configuration = serialize($params);
            $gatewayConfModel->createOrUpdate();

            $message = $request->all()['gatewayName'] . ' gateway has been updated.';
            $response = HttpResponse::success($message);

            return back()->with(['message' => $response]);
        }
        catch (\Throwable $exception) {
            $message = 'Update failed';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

    }

    public function testSend()
    {
        $helper = new SenderHelper();
        $helper->sendSMS(1, 'test');
    }


}
