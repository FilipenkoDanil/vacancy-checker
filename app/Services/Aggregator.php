<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

abstract class Aggregator
{
    protected int $count;

    public function __construct(protected string $query){}

    /**
     * Method parses count of vacancies.
     * @return void
     */
    abstract public function parse(): void;

    /**
     * Method checks old and new vacancy count.
     * @return bool
     */
    abstract public function isChanged(): bool;

    /**
     * Method creates new vacancy.
     * @return void
     */
    abstract public function createVacancy(): void;

    /**
     * Method sends notification to the user if the count of vacancies has been changed.
     * @return void
     */
    public function notify(): void
    {
        Http::post('https://api.telegram.org/bot' . env('TELEGRAM_API') . '/sendMessage', [
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'text' => class_basename($this) . ' - ' . $this->query . ': the number of vacancies has changed! Now: ' . $this->count
        ]);
    }

    /**
     * Method returns info about Aggregator - query - vacancy count.
     * @return string
     */
    public function getInfo(): string
    {
        return class_basename($this) . ' - ' . $this->query . ' - ' . $this->count . ' vacancies.' . PHP_EOL;
    }

    /**
     * Analyzes the data, notifies about changes, and creates a new vacancy.
     * @return string
     */
    public function analyse(): string
    {
        $this->parse();

        if ($this->isChanged()) {
            $this->notify();
        }

        $this->createVacancy();

        return $this->getInfo();
    }
}
