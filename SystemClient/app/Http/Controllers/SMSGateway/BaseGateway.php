<?php

namespace App\Http\Controllers\SMSGateway;

use App\Models\Gatewayconfiguration;

class BaseGateway implements GatewayInterface
{

    protected $id   = 'AbstractGatewayId';
    protected $name = 'AbstractGatewayName';
    protected $link = 'www.abstractGateway.com';
    protected $configuration;
    protected $configurationValues;

    public function __construct()
    {
        $this->configuration = $this->getConfiguration();

    }

    protected function getConfigurationValue($fieldValue)
    {
        $result = Gatewayconfiguration::where('name', $this->name)->first();

        if($result)
        {
            return unserialize($result->configuration)[$fieldValue];
        }

    }

    public function sendSms($clientId, $sms)
    {
        // TODO: Implement sendSms() method.
    }

    public function getConfiguration()
    {
        // TODO: Implement getConfiguration() method.
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

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

}
