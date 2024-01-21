<?php

namespace App\Services;

use DiDom\Document;
use Illuminate\Support\Facades\Log;

class Djinni extends Aggregator
{

    /**
     * @inheritDoc
     */
    public function getCount(): int
    {
        $query = urlencode($this->query);

        $doc = new Document("https://djinni.co/jobs/?keywords=$query", true);
        $count = (int)$doc->find('h1 span.text-muted')[0]->text();

        Log::info($count);
        return $count;
    }
}
