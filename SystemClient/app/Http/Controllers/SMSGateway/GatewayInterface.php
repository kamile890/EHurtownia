<?php

namespace App\Http\Controllers\SMSGateway;

interface GatewayInterface {

    public function sendSms($clientId, $sms);
    public function getConfiguration();
    public function testConnection();
    public function makeRequest();
}
