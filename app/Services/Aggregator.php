<?php

namespace App\Services;

abstract class Aggregator
{
    public function __construct(protected string $query){}

    /**
     * Method returns count of vacancies.
     * @return int
     */
    abstract public function getCount(): int;

    /**
     * Method returns info about Aggregator - query - vacancy count.
     * @return string
     */
    public function getInfo(): string
    {
        return class_basename($this) .  ' - ' . $this->query . ' - ' . $this->getCount() . ' vacancies.';
    }
}
