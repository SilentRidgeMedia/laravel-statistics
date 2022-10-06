<?php

namespace SilentRidge\Statistics\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use JetBrains\PhpStorm\NoReturn;
use SilentRidge\Statistics\Services\AggregationService;

class AggregateRawStatistics
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Collection $rawStatistics;

    public function __construct(Collection $rawStatistics)
    {
        $this->rawStatistics = $rawStatistics;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    #[NoReturn] public function handle(AggregationService $aggregationService)
    {
        $this->rawStatistics->groupBy('uuid')->each(function($items, $key) use ($aggregationService) {
            $aggregationService->aggregate($key, $items);
        });
    }
}
