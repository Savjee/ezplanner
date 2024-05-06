<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/today', [ApiController::class, 'today']);
Route::get('/overview', [ApiController::class, 'overview']);
