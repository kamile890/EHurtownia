<?php


namespace App\Http\Controllers\SMSGateway\Gateways;


use App\Http\Controllers\Helpers\SMSGatewayConfFieldTypes;
use App\Http\Controllers\SMSGateway\BaseGateway;

class SmsApi extends BaseGateway
{

    protected $id   = 'smsApi';
    protected $name = 'SMS API';
    protected $link = 'www.smsapi.pl';

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
