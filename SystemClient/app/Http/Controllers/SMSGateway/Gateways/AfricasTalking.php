<?php


namespace App\Http\Controllers\SMSGateway\Gateways;


use App\Http\Controllers\Helpers\SMSGatewayConfFieldTypes;
use App\Http\Controllers\SMSGateway\BaseGateway;

class AfricasTalking extends BaseGateway
{

    protected $id   = 'africasTalking';
    protected $name = 'AfricasTalking';
    protected $link = 'www.africastalking.com';



//    Dane testowe
//    API KEY = 'd2d61ea725d747a8b7b241ee43d0f81ae4349b9a6f3e02a5d67b298acb85bbac'
//    username = 'ehurtownik'

    public function getConfiguration()
    {
        return array(
            'username' => array(
                'type' => SMSGatewayConfFieldTypes::$text,
                'name' => 'Username',
            ),
            'apiKey' => array(
                'type' => SMSGatewayConfFieldTypes::$text,
                'name' => 'API KEY',
            )
        );
    }

    public function sendSms($phone, $sms)
    {
        $params = [
            'username' => $this->getConfigurationValue('username'),
            'to' => $phone,
            'message' => $sms,
        ];

        $this->makeRequest($params);
    }

    public function makeRequest($params)
    {

        $url = 'https://api.africastalking.com/version1/messaging';
        $headers = [];
        $headers[] = 'apiKey: ' . $this->getConfigurationValue('apiKey');
        $headers[] = "Accept: application/json";
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

        $response = $this->parseReponse(curl_exec($ch))->SMSMessageData->Recipients[0];

        if($response->statusCode != 101)
        {
            throw new \Exception($response->status);
        }

    }

    private function parseReponse($response)
    {
        $response = explode('sms-api', $response);
        return json_decode(trim($response[1]));
    }
}
