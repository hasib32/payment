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
        $queryBuilder = $this->model->where(function ($query) use ($searchCriteria) {

            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        }
        );
        $paymentData = $queryBuilder->get();

        Excel::create('paymentData', function($excel) use($paymentData) {

            $excel->sheet('Sheetname', function($sheet) use ($paymentData){

                $sheet->fromArray($paymentData);

            });
        })->export('xls');
    }
}