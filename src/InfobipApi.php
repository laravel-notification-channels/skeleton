<?php

namespace NotificationChannels\Infobip;

use infobip\api\AbstractApiClient;
use infobip\api\configuration\BasicAuthConfiguration;

class InfobipApi extends AbstractApiClient
{
    public function __construct($username, $password)
    {
        parent::__construct(new BasicAuthConfiguration($username, $password));
    }

    public function create($body, $accountKey = '_')
    {
        $restPath = $this->getRestUrl("settings/1/accounts/{$accountKey}/api-keys");

        $content = $this->executePOST($restPath, null, $body);

        return $this->map(json_decode($content), get_class(new InfobipApiResponse));
    }

    public function list($accountKey = '_', $enabled)
    {
        $restPath = $this->getRestUrl("settings/1/accounts/{$accountKey}/api-keys?enabled={$enabled}");

        $content = $this->executeGET($restPath, null);

        return $this->map(json_decode($content), get_class(new InfobipApiResponse));
    }

    public function update($key, $body, $accountKey = '_')
    {
        $restPath = $this->getRestUrl("settings/1/accounts/{$accountKey}/api-keys/{$key}");

        $content = $this->executePUT($restPath, null, $body);

        return $this->map(json_decode($content), get_class(new InfobipApiResponse));
    }

    public function get($key, $accountKey = '_')
    {
        $restPath = $this->getRestUrl("settings/1/accounts/{$accountKey}/api-keys/{$key}");

        $content = $this->executePOST($restPath, null, null);

        return $this->map(json_decode($content), get_class(new InfobipApiResponse));
    }

}
