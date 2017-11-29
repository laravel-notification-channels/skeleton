<?php

namespace NotificationChannels\Infobip\Console\Commands;

use NotificationChannels\Infobip\InfobipApi;
use Illuminate\Console\Command;

class ApiKeyCommand extends Command
{
    protected $config;

    public function __construct()
    {
        $this->config = config('services.infobip');
        parent::__construct();
    }

    protected function api()
    {
        return new InfobipApi($this->Username(), $this->Password());
    }

    protected function Username()
    {
        return $this->getConfigByKey('username');
    }

    protected function Password()
    {
        return $this->getConfigByKey('password');
    }

    protected function getConfigByKey($key)
    {
       return isset($this->config[$key])
            ? $this->config[$key]
            : $this->ask($key);
    }

}
