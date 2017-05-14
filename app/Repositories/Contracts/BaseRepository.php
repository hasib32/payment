<?php

namespace App\Repositories\Contracts;

interface BaseRepository
{
    /**
     * Find a resource by id
     *
     * @param $id
     * @return mixed
     */
    public function findOne($id);

    /**
     * Find a resource by criteria
     *
     * @param array $criteria
     * @return mixed
     */
    public function findOneBy(array $criteria);

    /**
     * Search All resources
     *
     * @param array $searchCriteria
     * @return mixed
     */
    public function findBy(array $searchCriteria = []);
}
