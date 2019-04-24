<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('superadmins', 'User\SuperAdminController');
Route::middleware('auth')->group(
    function () {
        
        Route::get(
            'superadministratorzy',
            'User\SuperAdmin\IndexController'
        )
        ->name('superadmins.index');


        Route::get(
            'administratorzy',
            'User\Admin\IndexController'
        )
        ->name('admins.index');


        Route::get(
            'pracodawcy',
            'User\Employer\IndexController'
        )
        ->name('employers.index');
        

        Route::get(
            'pracownicy',
            'User\Worker\IndexController'
        )
        ->name('workers.index');

        Route::post(
            'pracownicy',
            'User\Worker\StoreController'
        )
        ->name('workers.store');

        Route::get(
            'pracownicy/utworz',
            'User\Worker\CreateController'
        )
        ->name('workers.create');

        Route::get(
            'pracownicy/{worker}',
            'User\Worker\ShowController'
        )
        ->name('workers.show');

        Route::put(
            'pracownicy/{worker}',
            'User\Worker\UpdateController'
        )
        ->name('workers.update');

        Route::delete(
            'pracownicy/{worker}',
            'User\Worker\DestroyController'
        )
        ->name('workers.destroy');
        
        Route::get(
            'pracownicy/{worker}/edytuj',
            'User\Worker\EditController'
        )
        ->name('workers.edit');
        
        Route::get(
            'legenda',
            'Calendar\Legend\IndexController'
        )
        ->name('legends.index');
        

        Route::get(
            'wydarzenia',
            'Calendar\Event\IndexController'
        )
        ->name('events.index');

        Route::get(
            'wolne',
            'Calendar\PublicHoliday\IndexController'
        )
        ->name('holidays.index');
        
    }
);
