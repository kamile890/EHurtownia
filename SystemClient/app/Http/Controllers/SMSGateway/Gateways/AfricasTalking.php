<?php


namespace App\Http\Controllers\SMSGateway\Gateways;


use App\Http\Controllers\Helpers\SMSGatewayConfFieldTypes;
use App\Http\Controllers\SMSGateway\BaseGateway;

class AfricasTalking extends BaseGateway
{

    protected $id   = 'africasTalking';
    protected $name = 'AfricasTalking';
    protected $link = 'www.africastalking.com';

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

}
