<?php

namespace SilentRidge\Statistics\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;
use SilentRidge\Statistics\Http\Requests\RawStatisticsStoreRequest;
use SilentRidge\Statistics\Models\RawStatistic;

class RawStatisticsController extends BaseController
{
    public function store(RawStatisticsStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validatedData = $request->validated();

            (new RawStatistic())->store($validatedData['uuid'], $validatedData['data']);

            Artisan::call('aggregate:statistics');
            return response()->json(['message' => 'Statistics recorded.']);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
