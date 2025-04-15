<?php

namespace App\Services;

use App\Models\Vacancy;
use DiDom\Document;
use Illuminate\Support\Facades\Log;

class Djinni extends Aggregator
{
    /**
     * @inheritDoc
     */
    public function parse(): void
    {
        $query = urlencode($this->query);

        $doc = new Document("https://djinni.co/jobs/?all_keywords=$query", true);
        $count = (int)$doc->find('span.text-muted')[0]->text();

        $this->count = $count;
    }

    /**
     * @inheritDoc
     */
    public function isChanged(): bool
    {
        $aggregator = \App\Models\Aggregator::where('name', 'Djinni.co')->first();
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
        $aggregator = \App\Models\Aggregator::where('name', 'Djinni.co')->first();
        Vacancy::create([
            'aggregator_id' => $aggregator->id,
            'query' => $this->query,
            'count' => $this->count
        ]);
    }
}
