<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanningItemResource;
use App\Models\PlanningItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class ApiController extends Controller
{
    public function today(): JsonResponse
    {
        $todayItems = PlanningItem::where('date', today())
            ->get();

        return response()->json(
            PlanningItemResource::collection($todayItems)
        );
    }

    public function overview(): JsonResponse
    {
        $items = PlanningItem::where('date', '>=', today())
            ->get()
            ->groupBy("date");

        $output = $items->map(function(Collection $itemsInDate){
            $itemCollection = PlanningItemResource::collection($itemsInDate);
            return [
                'date' => $itemCollection->first()->date,
                'data' => $itemCollection,
            ];
        });
 
        return response()->json(
            $output->values()
        );
    }
}
