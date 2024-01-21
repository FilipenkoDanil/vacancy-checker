<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Robota extends Aggregator
{

    /**
     * @inheritDoc
     */
    public function getCount(): int
    {
        $client = new Client();
        $res = $client->get("https://api.rabota.ua/vacancy/search?keyWords=$this->query&scheduleId=3");
        $res = json_decode($res->getBody()->getContents());

        Log::info($res->total);
        return $res->total;
    }
}
