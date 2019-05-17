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

// Route::middleware('auth:api')->group(
    // function () {
        /*
        Route::apiResource('legends', 'API\LegendController')
        ->only(['index', 'store', 'destroy']);
        */
        Route::get('legends', 'API\LegendController@index')
            ->name('api.legends.index');
        Route::post('legends', 'API\LegendController@store')
            ->name('api.legends.store');
        Route::delete('legends/{legend}', 'API\LegendController@destroy')
            ->name('api.legends.destroy');
        /*
        Route::apiResource('events', 'API\EventController')
            ->only(['index', 'store', 'destroy']);
        */
        Route::get('events', 'API\EventController@index')
            ->name('api.events.index');
        Route::post('events', 'API\EventController@store')
            ->name('api.events.store');
        Route::delete('events/{event}', 'API\EventController@destroy')
            ->name('api.events.destroy');
        /*
        Route::apiResource('users', 'API\UserController')
            ->only(['index']);
        */
        Route::get('users', 'API\UserController@index')
            ->name('api.users.index');
        /*    
        Route::apiResource('user_types', 'API\TypeController')
            ->only(['index']);
        */
        Route::get('user_types', 'API\TypeController@index')
            ->name('api.user_types.index');
        /*
        Route::apiResource('public_holidays', 'API\PublicHolidayController')
            ->only(['index']);
        */
        Route::get('public_holidays', 'API\PublicHolidayController@index')
            ->name('api.public_holidays.index');
        /*
        Route::get(
            'nearest_public_holidays',
            'API\NearestPublicHolidayController'
        )->name('nearest_public_holidays.index');
        */
        Route::get(
            'nearest_public_holidays',
            'API\NearestPublicHolidayController'
        )->name('api.nearest_public_holidays.index');
        /*
        Route::get(
            'employers/{employer}/workers/{worker}',
            'API\EmployerController@event'
        )->name('employers.workers.event');
        */
        Route::get(
            'employers/{employer}/workers/{worker}',
            'API\EmployerController@event'
        )->name('api.employers.workers.event');

        
        Route::get('employers', 'API\EmployerController@index')
            ->name('api.employers.index');
        Route::get('employers/{employer}', 'API\EmployerController@show')
            ->name('api.employers.show');

        Route::get('workers', 'API\WorkerController@index')
            ->name('api.workers.index');
        Route::get('workers/{worker}', 'API\WorkerController@show')
            ->name('api.workers.show');
        Route::post('workers', 'API\WorkerController@store')
            ->name('api.workers.store');
        Route::put('workers/{worker}', 'API\WorkerController@update')
            ->name('api.workers.update');
        Route::delete('workers/{worker}', 'API\WorkerController@destroy')
            ->name('api.workers.destroy');
        /*
        Route::apiResource('employers', 'API\EmployerController')
            ->only(['index', 'show']);
        */
        /*
        Route::apiResource('workers', 'API\WorkerController')
            ->only(['index', 'show']);
        */
    // }
// );
