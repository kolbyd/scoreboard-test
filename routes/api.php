<?php

use App\Http\Controllers\Api\ClockController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\PeriodController;
use App\Http\Controllers\Api\ScoreController;
use App\Http\Controllers\Api\ShotsController;
use App\Http\Controllers\Api\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TeamController::class)->prefix('teams')->group(function () {
    Route::get('/', 'index');
    Route::post('create', 'create');
    Route::get('/{id}', 'show');
});

Route::controller(ClockController::class)->prefix('clock')->group(function () {
    Route::post('start', 'startClock');
    Route::post('stop', 'stopClock');
});

Route::controller(GameController::class)->prefix('game')->group(function () {
    Route::get('/', 'show');
});

Route::controller(ScoreController::class)->prefix('score')->group(function () {
    Route::post('visitor', 'updateVisitorScore');
    Route::post('home', 'updateHomeScore');
});

Route::controller(ShotsController::class)->prefix('shots')->group(function () {
    Route::post('visitor', 'updateVisitorShots');
    Route::post('home', 'updateHomeShots');
});

Route::post('period', [PeriodController::class, 'updatePeriod']);
