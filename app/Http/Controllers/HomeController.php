<?php

namespace App\Http\Controllers;

use App\Models\PlanningItem;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $dateRange = collect(
            CarbonPeriod::create('today', '1 day', 10)
        );

        $sections = collect(
            explode(",", env('SECTIONS'))
        );

        // Fetch all future PlanningItem's in 1 go
        $planningItems = PlanningItem::where('date', '>=', today())
            ->get();

        $dateRange = $dateRange->map(function(Carbon $date) use($sections, $planningItems) {
            return [
                "date" => $date,
                "sections" => $sections->map(function(string $section) use ($date, $planningItems) {
                    $preExists = $planningItems->where('date', $date)
                        ->where('section', $section)
                        ->first();

                    if($preExists){
                        return $preExists;
                    }

                    return PlanningItem::create([
                        'date' => $date,
                        'section' => $section,
                    ]);
                })
            ];
        });
        
        // dd($dateRange);

        return view('welcome')
            ->with('daterange', $dateRange)
            ->with('test', $request->header('X-Ingress-Path'));
    }
}
