<?php

namespace App\Services;

use DiDom\Document;
use Illuminate\Support\Facades\Log;

class Dou extends Aggregator
{
    /**
     * @inheritDoc
     */
    public function getCount(): int
    {
        $doc = new Document("https://jobs.dou.ua/vacancies/?search=$this->query", true);
        $count = (int)$doc->find('h1')[0]->text();

        Log::info($count);
        return $count;
    }
}
