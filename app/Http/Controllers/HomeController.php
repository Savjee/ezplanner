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

        $dateRange = $dateRange->map(function(Carbon $date) use($sections) {
            return [
                "date" => $date,
                "sections" => $sections->map(function(string $section) use ($date) {
                    return PlanningItem::firstOrCreate([
                        'date' => $date,
                        'section' => $section,
                        // 'value' => Str::random(),
                    ]);
                })
            ];
        });
        
        // dd($dateRange);

        return view('welcome')
            ->with('daterange', $dateRange);
    }
}
