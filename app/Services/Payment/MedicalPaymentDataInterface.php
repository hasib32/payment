<?php

namespace App\Services\Payment;

interface MedicalPaymentDataInterface
{
    /**
     * Get Medical Data from the API
     *
     * @param array $params
     * @return array
     */
    public function getData(array $params);

    /**
     * Transform Data using mapper
     *
     * @param array $data
     * @return array
     */
    public function transformData(array $data);
}