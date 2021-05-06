<?php

namespace App\Http\Controllers\Helpers;



use App\Http\Controllers\SMSGateway\BaseGateway;
use App\Http\Controllers\SMSGateway\Gateways\AfricasTalking;
use App\Models\Gatewayconfiguration;
use App\Models\Setting;
use App\Models\Template;
use App\Models\User;



class SenderHelper
{

    public static function sendSMS($clientId, $templateId)
    {
        $selectedGateway = Setting::getSelectedGateway();

        $client = User::where('id', $clientId)->first();
        $template = Template::where('id', $templateId)->first();
        if(!$client)
        {
            //log
            return;
        }

        if(!$client->numer_telefonu)
        {
            //log
            return;
        }

        if(!$template)
        {
            //log
            return;
        }

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

            $message = MessageCreator::getMessage($client, $template);
            //być może namespace error wyrzuci
            $gateway = new AfricasTalking();
            $gateway->sendSms($client->numer_telefonu, $message);
        }
        catch(\Exception $ex)
        {
            //log
        }

    }


}
