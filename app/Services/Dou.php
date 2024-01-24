<?php

namespace App\Services;

use App\Models\Vacancy;
use DiDom\Document;

class Dou extends Aggregator
{
    /**
     * @inheritDoc
     */
    public function parse(): void
    {
        $doc = new Document("https://jobs.dou.ua/vacancies/?search=$this->query", true);
        $count = (int)$doc->find('h1')[0]->text();

        $this->count = $count;
    }

    /**
     * @inheritDoc
     */
    public function isChanged(): bool
    {
        $aggregator = \App\Models\Aggregator::where('name', 'Dou.ua')->first();
        $vacancy = Vacancy::where('aggregator_id', $aggregator->id)->where('query', $this->query)->latest()->first();

        if (!$vacancy) {
            return false;
        }

        return $vacancy->count !== $this->count;
    }

    /**
     * @inheritDoc
     */
    public function createVacancy(): void
    {
        $aggregator = \App\Models\Aggregator::where('name', 'Dou.ua')->first();
        Vacancy::create([
            'aggregator_id' => $aggregator->id,
            'query' => $this->query,
            'count' => $this->count
        ]);
    }
}
