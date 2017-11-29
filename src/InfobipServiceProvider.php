<?php

namespace NotificationChannels\Infobip;

use Illuminate\Support\ServiceProvider;
use infobip\api\configuration\ApiKeyAuthConfiguration;
use infobip\api\client\SendSingleTextualSms;
use NotificationChannels\Infobip\Exceptions\InvalidConfiguration;
use NotificationChannels\Infobip\Console\Commands\CreateApiKeyCommand;
use NotificationChannels\Infobip\Console\Commands\ListAllApiKeysCommand;
use NotificationChannels\Infobip\Console\Commands\GetApiKeyCommand;
use NotificationChannels\Infobip\Console\Commands\UpdateApiKeyCommand;

class InfobipServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateApiKeyCommand::class,
                ListAllApiKeysCommand::class,
                GetApiKeyCommand::class,
                UpdateApiKeyCommand::class,
            ]);
        }

        $this->app->when(Infobip::class)
            ->needs(SendSingleTextualSms::class)
            ->give(function() {

                $config = config('services.infobip');

                if (is_null($config)) {
                    throw InvalidConfiguration::configurationNotSet();
                }

                return new SendSingleTextualSms(
                    new ApiKeyAuthConfiguration($config['apiKey'])
                );

            });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
