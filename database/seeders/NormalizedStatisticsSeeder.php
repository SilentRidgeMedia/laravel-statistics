<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NormalizedStatistics;

class NormalizedStatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NormalizedStatistics::factory()
            ->count(5)
            ->create();
    }
}
