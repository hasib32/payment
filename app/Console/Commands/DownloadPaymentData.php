<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class DownloadPaymentData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:paymentData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download payment api data';

    /**
     * Http client instance
     *
     * @var Client
     */
    protected $httpClient;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->httpClient = new Client();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Download started');

        $response = $this->httpClient->get('https://openpaymentsdata.cms.gov/resource/k8gn-hat5.json?$limit=5000');
        $result = json_decode($response->getBody(), true);

        $file = fopen(public_path('payment.json'), 'w');

        $bar = $this->output->createProgressBar(count($result));

        foreach ($result as $line) {
            fwrite($file, json_encode($line));

            $bar->advance();
        }

        $bar->finish();

        $this->info('Finished downloading!');
    }
}
