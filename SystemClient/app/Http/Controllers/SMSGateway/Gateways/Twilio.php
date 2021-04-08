<?php

namespace App\Http\Controllers\SMSGateway\Gateways;

use App\Http\Controllers\SMSGateway\AbstractGateway;

class Twilio extends AbstractGateway
{

    protected $name = 'Twilioooo';
    protected $link = 'www.twilio.com';



    public function getConfiguration()
    {
        return array(
          'Account SID' => array(
              'type' => SMSGatewayConfFieldTypes::$text
          ),
          'Auth Token' => array(
               'type' => SMSGatewayConfFieldTypes::$text
          )
        );
    }

    public function testConnection()
    {
        $this->makeRequest();
    }

    public function sendSms($clientId, $sms)
    {

        $this->makeRequest();
    }


    public function makeRequest()
    {



    }

}
