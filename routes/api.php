<?php

use Illuminate\Support\Facades\Route;
use SilentRidge\Statistics\Http\Controllers\Api\NormalizedStatisticsController;
use SilentRidge\Statistics\Http\Controllers\Api\RawStatisticsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'api'], function () {
    Route::apiResource('raw-statistics', RawStatisticsController::class)
         ->only(['store']);

    Route::apiResource('normalized-statistics', NormalizedStatisticsController::class)
         ->only(['show'])
         ->parameters(['statistics' => 'uuid']);
});
