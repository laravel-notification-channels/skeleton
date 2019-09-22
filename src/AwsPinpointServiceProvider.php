<?php

namespace NotificationChannels\AwsPinpoint;

use Aws\Laravel\AwsFacade;
use Illuminate\Support\ServiceProvider;

class AwsPinpointServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(AwsPinpointChannel::class)
            ->needs(AwsPinpointClient::class)
            ->give(function () {
                $config = config('aws.Pinpoint');

                if (is_null($config)) {
                    throw InvalidConfiguration::configurationNotSet();
                }

                $client = AwsFacade::createClient(
                    'pinpoint',
                    [
                        'credentials' => [
                            'key' => $config['key'],
                            'secret' => $config['secret'],
                        ],
                    ]
                );

                return new AwsPinpointClient($client);
            });
    }
}
