<?php

namespace App\Repositories;

use App\Models\MedicalPayment;
use App\Repositories\Contracts\PaymentDataRepository;
use Maatwebsite\Excel\Facades\Excel;

class EloquentPaymentDataRepository extends AbstractEloquentRepository implements PaymentDataRepository
{
    /**
     * Model name
     *
     * @var string
     */
    protected $modelName = MedicalPayment::class;

    /**
     * @inheritdoc
     */
    public function exportData(array $searchCriteria = [])
    {
        $key = key($searchCriteria);

        $this->model->where($key, $searchCriteria[$key])->chunk(1500, function ($paymentData) {
            Excel::create('paymentData', function($excel) use($paymentData) {

                $excel->sheet('Sheetname'.rand(1, 100), function($sheet) use ($paymentData){

                    $sheet->fromArray($paymentData);

                });
            })->export('xls');
        });
    }
}