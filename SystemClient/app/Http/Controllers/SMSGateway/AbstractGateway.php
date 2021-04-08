<?php

namespace App\Http\Controllers\SMSGateway;

abstract class AbstractGateway implements GatewayInterface
{

    protected $name = 'AbstractGateway';
    protected $link = 'www.abstractGateway.com';


    public function sendSms($clientId, $sms)
    {
        // TODO: Implement sendSms() method.
    }

    public function getConfiguration()
    {
        // TODO: Implement getConfiguration() method.
    }

    public function testConnection()
    {
        // TODO: Implement testConnection() method.
    }

    public function makeRequest()
    {
        // TODO: Implement makeRequest() method.
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }


}
