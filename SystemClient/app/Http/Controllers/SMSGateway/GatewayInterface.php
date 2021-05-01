<?php

namespace App\Http\Controllers\SMSGateway;

interface GatewayInterface {

    public function sendSms($phone, $sms);
    public function getConfiguration();
}
