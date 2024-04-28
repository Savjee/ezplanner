<?php

namespace App\Http\Controllers;

use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('welcome')
           ->with('daterange', CarbonPeriod::create('now', '1 day', 10))
           ->with('sections', explode(",", env('SECTIONS')));
    }
}
