<?php

namespace NotificationChannels\Infobip\Console\Commands;

class UpdateApiKeyCommand extends ApiKeyCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infobip:update-api-key
                            {key : Key used to uniquely identify API key.}
                            {accountKey=_ : Key used to uniquely identify the account. Use _ as parameter value for your current account or account key for sub accounts.}
                            {--name= : APi key name for easy distinction between multiple API keys. }
                            {--ip=* : Array of allowed IP addresses for API call origin. If allowedIPs is not included, there will be no IP restrictions for API requests.}
                            {--permissions=* : List of API permission collections. Possible values are ALL - for all APIs and TFA - for methods required to perform client side TFA. If permissions are not specified, ALL will be set by default.}
                            {--validFrom= : Valid from date.}
                            {--validTo= : Valid to date.}
                            {--enabled= : Whether API key is enabled for use.}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update an API Key';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $key = $this->argument('key');

        $body = $this->options();

        $accountKey = $this->argument('accountKey');

        $response = $this->api()->update($key, $body, $accountKey);

        dump($response);
    }
}
