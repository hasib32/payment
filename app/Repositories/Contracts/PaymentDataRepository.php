<?php

namespace App\Repositories\Contracts;

interface PaymentDataRepository extends BaseRepository
{
    /**
     * Export query results into xls file
     *
     * @param array $searchCriteria
     * @return mixed
     */
    public function exportData(array $searchCriteria = []);
}