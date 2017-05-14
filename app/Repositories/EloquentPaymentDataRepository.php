<?php

namespace App\Repositories;

use App\Models\MedicalPayment;
use App\Repositories\Contracts\PaymentDataRepository;

class EloquentPaymentDataRepository extends AbstractEloquentRepository implements PaymentDataRepository
{
    /**
     * Model name
     *
     * @var string
     */
    protected $modelName = MedicalPayment::class;
}