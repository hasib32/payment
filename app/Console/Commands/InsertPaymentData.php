<?php

namespace App\Console\Commands;

use App\Services\Payment\MedicalPaymentDataInterface;
use App\Services\Payment\SodaPaymentData;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class InsertPaymentData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment-data:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download and Insert Payment API Data';

    /**
     * Http client instance
     *
     * @var Client
     */
    protected $httpClient;

    /**
     * MedicalPaymentDataInterface instance
     *
     * @var MedicalPaymentDataInterface
     */
    protected $medicalPaymentData;
    /**
     * Create a new command instance.
     *
     * @param MedicalPaymentDataInterface $medicalPaymentData
     */
    public function __construct(MedicalPaymentDataInterface $medicalPaymentData)
    {
        parent::__construct();

        $this->httpClient = new Client();
        $this->medicalPaymentData = $medicalPaymentData;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Download started..');

        $offset = 0;
        $count = 1; // Needed for ProgressBar file count
        do {
            $this->info('Processing file # '. $count);
            $count++;

            $paymentData = $this->medicalPaymentData->getData([
                '$$exclude_system_fields'   => 'false',
                '$where'                    => 'total_amount_of_payment_usdollars > 10',
                '$limit'                    => 5000,
                '$offset'                   => $offset
            ]);

            $offset += 5000;

            $file = fopen(public_path('payment.json'), 'w');

            $bar = $this->output->createProgressBar(count($paymentData));

            foreach ($paymentData as $line) {
                $line = $this->medicalPaymentData->transformData($line);

                fwrite($file, json_encode($line));

                $bar->advance();
            }

            fclose($file);

            $filePath = public_path("payment.json");
            // insert data into mongodb
            exec("mongoimport --db reorg --collection medical_payment --file $filePath");

            // Delete json file
            unlink($filePath);

            $bar->finish();

            $this->info('Finished downloading!');

        } while(!empty($paymentData) && isset($paymentData[0][':id']));
    }
}
