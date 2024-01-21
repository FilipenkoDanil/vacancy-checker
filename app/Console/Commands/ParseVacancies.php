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
        Robota::getCount($this->argument('query'));
        Dou::getCount($this->argument('query'));
        Djinni::getCount($this->argument('query'));

        return Command::SUCCESS;
    }
}
