<?php

namespace App\Http\Controllers\Helpers;



use App\Http\Controllers\SMSGateway\BaseGateway;
use App\Http\Controllers\SMSGateway\Gateways\AfricasTalking;
use App\Models\Gatewayconfiguration;
use App\Models\Setting;

class SenderHelper
{

    public static function sendSMS($clientId, $templateId)
    {
        $selectedGateway = Setting::getSelectedGateway();

        if($selectedGateway == '0')
        {
            //log
            return;
        }

        $configuration = Gatewayconfiguration::where('name', $selectedGateway)->first();
        if(!$configuration)
        {
            //log
            return;
        }


        try{
            //
            $gateway = new AfricasTalking();
            $gateway->sendSms(1, 'test');
        }
        catch(\Exception $ex)
        {
            //log
        }

    }


}
