<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanningItemResource;
use App\Models\PlanningItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
