<?php

namespace App\Services;

use App\Models\Vacancy;
use GuzzleHttp\Client;

class Robota extends Aggregator
{
    /**
     * @inheritDoc
     */
    public function parse(): void
    {
        $client = new Client();
        $res = $client->get("https://api.rabota.ua/vacancy/search?keyWords=$this->query&scheduleId=3");
        $res = json_decode($res->getBody()->getContents());

        $this->count = $res->total;
    }

    /**
     * @inheritDoc
     */
    public function isChanged(): bool
    {
        $aggregator = \App\Models\Aggregator::where('name', 'Robota.ua')->first();
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
        $aggregator = \App\Models\Aggregator::where('name', 'Robota.ua')->first();
        Vacancy::create([
            'aggregator_id' => $aggregator->id,
            'query' => $this->query,
            'count' => $this->count
        ]);
    }
}
