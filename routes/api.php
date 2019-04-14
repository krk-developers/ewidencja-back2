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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::apiResource('legends', 'API\LegendController')
    ->only(['index']);

Route::apiResource('events', 'API\EventController')
    ->only(['index']);

Route::apiResource('users', 'API\UserController')
    ->only(['index']);

Route::apiResource('user_types', 'API\TypeController')
    ->only(['index']);
