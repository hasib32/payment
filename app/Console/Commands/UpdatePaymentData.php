<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Payment\MedicalPaymentDataInterface;

class UpdatePaymentData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment-data:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download and Update Payment API Data';

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

        $dateTimeObject = new \DateTime('now');
        $currentDate = $dateTimeObject->format('Y-m-d');

        $offset = 0;
        $count = 1; // Needed for ProgressBar file count
        do {
            $this->info('Processing file # '. $count);
            $count++;

            $paymentData = $this->medicalPaymentData->getData([
                '$$exclude_system_fields'   => 'false',
                '$where'                    => "total_amount_of_payment_usdollars > 10 AND :updated_at > '$currentDate'",
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
            // update data into mongodb
            exec("mongoimport --db reorg --collection medical_payment --upsertFields provider_id --file $filePath");

            // Delete json file
            unlink($filePath);

            $bar->finish();

            $this->info('Finished downloading!');

        } while(!empty($paymentData) && isset($paymentData[0][':id']));
    }
}
