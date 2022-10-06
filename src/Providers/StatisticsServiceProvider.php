<?php

namespace SilentRidge\Statistics\Providers;

use Illuminate\Support\ServiceProvider;
use SilentRidge\Statistics\Commands\AggregateStatisticsCommand;
use SilentRidge\Statistics\Services\AggregationService;
use SilentRidge\Statistics\Contracts\AggregationContract;

class StatisticsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerResources();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([ AggregateStatisticsCommand::class ]);
        $this->registerDependencies();
    }

    protected function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->registerRoutes();
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
    }

    protected function registerDependencies()
    {
        $this->app->bind(AggregationContract::class, AggregationService::class);
    }
}
