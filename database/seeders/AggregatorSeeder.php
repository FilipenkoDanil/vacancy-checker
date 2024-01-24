<?php

namespace Database\Seeders;

use App\Models\Aggregator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AggregatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aggregators = ['Robota.ua', 'Dou.ua', 'Djinni.co'];

        foreach ($aggregators as $aggregator) {
            Aggregator::create([
                'name' => $aggregator
            ]);
        }
    }
}
