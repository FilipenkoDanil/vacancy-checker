<?php

namespace App\Services;

abstract class Aggregator
{
    /**
     * Method returns count of vacancies.
     * @param string $query
     * @return mixed
     */
    abstract static public function getCount(string $query): int;
}
