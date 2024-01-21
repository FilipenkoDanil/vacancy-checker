<?php

namespace App\Services;

use DiDom\Document;
use Illuminate\Support\Facades\Log;

class Dou extends Aggregator
{
    /**
     * @param string $query
     * @inheritDoc
     */
    static public function getCount(string $query): int
    {
        $doc = new Document("https://jobs.dou.ua/vacancies/?search=$query", true);
        $count = (int)$doc->find('h1')[0]->text();

        Log::info($count);
        return $count;
    }
}
