<?php

namespace Database\Seeders;

use App\Models\RawStatistics;
use Illuminate\Database\Seeder;

class RawStatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RawStatistics::factory()
            ->count(5)
            ->create();
    }
}
