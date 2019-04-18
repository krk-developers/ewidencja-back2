<?php

// use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);
*/
Route::middleware('auth:api')->group(
    function () {
        Route::apiResource('legends', 'API\LegendController')
            ->only(['index', 'store', 'destroy']);
    }
);

Route::apiResource('events', 'API\EventController')
    ->only(['index', 'store', 'destroy']);

Route::apiResource('users', 'API\UserController')
    ->only(['index']);

Route::apiResource('user_types', 'API\TypeController')
    ->only(['index']);
    
Route::apiResource('public_holidays', 'API\PublicHolidayController')
    ->only(['index']);

Route::get(
    'nearest_public_holidays',
    'API\NearestPublicHolidayController'
)->name('nearest_public_holidays.index');

Route::get('employers/{employer}/workers/{worker}', 'API\EmployerController@event')
    ->name('employers.workers.event');
Route::apiResource('employers', 'API\EmployerController')
    ->only(['index', 'show']);

Route::apiResource('workers', 'API\WorkerController')
    ->only(['index', 'show']);
