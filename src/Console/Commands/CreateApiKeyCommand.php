<?php

namespace NotificationChannels\Infobip\Console\Commands;

use Illuminate\Console\Command;

class CreateApiKeyCommand extends ApiKeyCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infobip:create-api-key
                            {name : APi key name for easy distinction between multiple API keys. }
                            {accountKey=_ : Key used to uniquely identify the account. Use _ as parameter value for your current account or account key for sub accounts.}
                            {--ip=* : Array of allowed IP addresses for API call origin. If allowedIPs is not included, there will be no IP restrictions for API requests.}
                            {--permissions=* : List of API permission collections. Possible values are ALL - for all APIs and TFA - for methods required to perform client side TFA.}
                            {--validFrom= : Valid from date.}
                            {--validTo= : Valid to date.}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an API Key';

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
        $accountKey = $this->argument('accountKey');

        $body = $this->options();

        $body['name'] = $this->argument('name');

        $response = $this->api()->create($body, $accountKey);

        dump($response);
    }
}
