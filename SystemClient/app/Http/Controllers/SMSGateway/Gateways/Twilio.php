<?php

namespace App\Http\Controllers\SMSGateway\Gateways;

use App\Http\Controllers\Helpers\SMSGatewayConfFieldTypes;
use App\Http\Controllers\SMSGateway\BaseGateway;

class Twilio extends BaseGateway
{

    protected $id   = 'twilio';
    protected $name = 'Twilio';
    protected $link = 'www.twilio.com';

    const ENDPOINT = 'https://api.twilio.com/2010-04-01';


    public function getConfiguration()
    {
        return array(
          'accountSid' => array(
              'type' => SMSGatewayConfFieldTypes::$text,
              'name' => 'Account SID',
          ),
          'authToken' => array(
               'type' => SMSGatewayConfFieldTypes::$text,
               'name' => 'Auth Token',
          )
        );
    }

    public function testConnection()
    {
        $this->makeRequest();
    }

    public function sendSms($clientId, $sms)
    {

        var_dump($this->getConfigurationValue('accountSid'));
        exit();
        $this->makeRequest();
    }


    public function makeRequest()
    {

        $url = self::ENDPOINT;


    }

}
