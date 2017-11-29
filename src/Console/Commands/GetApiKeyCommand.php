<?php

namespace NotificationChannels\Infobip\Console\Commands;

class GetApiKeyCommand extends ApiKeyCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infobip:get-api-key
                                {key}
                                {accountKey=_ : Key used to uniquely identify the account. Use _ as parameter value for your current account or account key for sub accounts.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a single API key';

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

        $accountKey = $this->argument('accountKey');

        $response = $this->api()->get($key, $accountKey);

        dump($response);
    }
}
