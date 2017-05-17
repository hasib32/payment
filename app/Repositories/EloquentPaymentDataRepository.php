<?php

namespace App\Repositories;

use App\Models\MedicalPayment;
use App\Repositories\Contracts\PaymentDataRepository;
use App\Services\Payment\MedicalPaymentDataInterface;
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
     * Instance of MedicalPaymentDataInterface
     *
     * @var MedicalPaymentDataInterface
     */
    private $medicalPaymentDataInterface;

    /**
     * Constructor
     *
     * @param MedicalPaymentDataInterface $medicalPaymentDataInterface
     */
    public function __construct(MedicalPaymentDataInterface $medicalPaymentDataInterface)
    {
        parent::__construct();

        $this->medicalPaymentDataInterface = $medicalPaymentDataInterface;
    }

    /**
     * @inheritdoc
     */
    public function exportData(array $searchCriteria = [])
    {
        $queryBuilder = $this->model->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $fileHeader = array_keys($this->medicalPaymentDataInterface->transformData([]));
        array_unshift($fileHeader, 'id');

        Excel::create('paymentData', function($excel) use($queryBuilder, $fileHeader) {

            $excel->sheet('Sheetname', function($sheet) use ($queryBuilder, $fileHeader) {
                // set header
                $sheet->appendRow($fileHeader);

                $queryBuilder->chunk(1500, function ($paymentData) use($sheet) {
                    foreach ($paymentData as $row) {
                        $sheet->appendRow($row->toArray());
                    }

                });
            });
        })->export('xls');
    }
}