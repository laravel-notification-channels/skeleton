<?php

namespace NotificationChannels\Infobip\Console\Commands;

use Illuminate\Console\Command;

class ListAllApiKeysCommand extends ApiKeyCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infobip:list-api-keys
                            {accountKey=_ : Key used to uniquely identify the account. Use _ as parameter value for your current account or account key for sub accounts.}
                            {--enabled=true}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all API keys';

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
        $enabled = $this->option('enabled');

        $response = $this->api()->list($accountKey, $enabled);

        dump($response->getApiKeys());
    }
}
