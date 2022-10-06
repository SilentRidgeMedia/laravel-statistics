<?php

namespace SilentRidge\Statistics\Commands;

use SilentRidge\Statistics\Jobs\AggregateRawStatistics;
use Illuminate\Console\Command;
use SilentRidge\Statistics\Models\RawStatistic;

class AggregateStatisticsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aggregate:statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggregate statistics for all users';


    public function handle()
    {
        $rawStats = RawStatistic::all();
        AggregateRawStatistics::dispatch($rawStats);
    }
}
