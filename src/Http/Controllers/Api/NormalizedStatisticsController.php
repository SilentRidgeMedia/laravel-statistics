<?php

namespace SilentRidge\Statistics\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use SilentRidge\Statistics\Models\NormalizedStatistic;

class NormalizedStatisticsController extends BaseController
{
    public function show(string $uuid): \Illuminate\Http\JsonResponse
    {
        try {
            $entities = (new NormalizedStatistic)->getByUuid($uuid);

            return response()->json(['data' => $entities]);

        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
