<?php

namespace App\Console\Commands;

use App\Services\Djinni;
use App\Services\Dou;
use App\Services\Robota;
use Illuminate\Console\Command;

class ParseVacancies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:vacancies {query}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the count of vacancies.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $robota = new Robota($this->argument('query'));
        $dou = new Dou($this->argument('query'));
        $djinni = new Djinni($this->argument('query'));

        $aggregators = [$robota, $dou, $djinni];
        $info = '';

        foreach ($aggregators as $aggregator) {
            $info .= $aggregator->getInfo() . PHP_EOL;
        }

        $this->info($info);

        return Command::SUCCESS;
    }
}
