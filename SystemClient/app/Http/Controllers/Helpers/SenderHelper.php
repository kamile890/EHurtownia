<?php

namespace App\Http\Controllers\Helpers;


use App\Http\Controllers\SMSGateway\Gateways\Twilio;

class SenderHelper
{


    public function sendSMS($clientId, $templateId)
    {
        $gateway = new Twilio();
        $gateway->sendSms(1, 'test');
    }


}
