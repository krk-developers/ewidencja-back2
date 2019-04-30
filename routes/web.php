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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/wyloguj', 'WelcomeController@logout')->name('bye');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')->group(
    function () {
        
        // superadmin ////////////////////////////////////////////////////////
        Route::get(
            'superadministratorzy',
            'User\SuperAdmin\IndexController'
        )
        ->name('superadmins.index');

        Route::post(
            'superadministratorzy',
            'User\SuperAdmin\StoreController'
        )
        ->name('superadmins.store');

        Route::get(
            'superadministratorzy/utworz',
            'User\SuperAdmin\CreateController'
        )
        ->name('superadmins.create');

        Route::get(
            'superadministratorzy/{superadmin}',
            'User\SuperAdmin\ShowController'
        )
        ->name('superadmins.show');

        Route::put(
            'superadministratorzy/{superadmin}',
            'User\SuperAdmin\UpdateController'
        )
        ->name('superadmins.update');

        Route::delete(
            'superadministratorzy/{superadmin}',
            'User\SuperAdmin\DestroyController'
        )
        ->name('superadmins.destroy');

        Route::get(
            'superadministratorzy/{superadmin}/edytuj',
            'User\SuperAdmin\EditController'
        )
        ->name('superadmins.edit');

        // admin /////////////////////////////////////////////////////////////
        Route::get(
            'administratorzy',
            'User\Admin\IndexController'
        )
        ->name('admins.index');

        Route::post(
            'administratorzy',
            'User\Admin\StoreController'
        )
        ->name('admins.store');

        Route::get(
            'administratorzy/utworz',
            'User\Admin\CreateController'
        )
        ->name('admins.create');

        Route::get(
            'administratorzy/{admin}',
            'User\Admin\ShowController'
        )
        ->name('admins.show');

        Route::put(
            'administratorzy/{admin}',
            'User\Admin\UpdateController'
        )
        ->name('admins.update');

        Route::delete(
            'administratorzy/{admin}',
            'User\Admin\DestroyController'
        )
        ->name('admins.destroy');

        Route::get(
            'administratorzy/{admin}/edytuj',
            'User\Admin\EditController'
        )
        ->name('admins.edit');

        // employer //////////////////////////////////////////////////////////
        Route::get(
            'pracodawcy',
            'User\Employer\IndexController'
        )
        ->name('employers.index');

        Route::post(
            'pracodawcy',
            'User\Employer\StoreController'
        )
        ->name('employers.store');

        Route::get(
            'pracodawcy/utworz',
            'User\Employer\CreateController'
        )
        ->name('employers.create');

        Route::get(
            'pracodawcy/{employer}',
            'User\Employer\ShowController'
        )
        ->name('employers.show');

        Route::put(
            'pracodawcy/{employer}',
            'User\Employer\UpdateController'
        )
        ->name('employers.update');

        Route::delete(
            'pracodawcy/{employer}',
            'User\Employer\DestroyController'
        )
        ->name('employers.destroy');
        
        Route::get(
            'pracodawcy/{employer}/edytuj',
            'User\Employer\EditController'
        )
        ->name('employers.edit');
        
        //

        Route::get(
            'pracodawcy/{employer}/pracownicy/dodaj',
            'User\Employer\Worker\CreateController'
        )
        ->name('employers.workers.create');

        Route::post(
            'pracodawcy/{employer}/pracownicy',
            'User\Employer\Worker\StoreController'
        )
        ->name('employers.workers.store');

        Route::delete(
            'pracodawcy/{employer}/pracownicy/{worker}',
            'User\Employer\Worker\DestroyController'
        )
        ->name('employers.workers.destroy');

        // worker ////////////////////////////////////////////////////////////
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
        
        //

        Route::get(
            'pracownicy/{worker}/pracodawcy/dodaj',
            'User\Worker\Employer\CreateController'
        )
        ->name('workers.employers.add');
        
        Route::post(
            'pracownicy/{worker}/pracodawcy',
            'User\Worker\Employer\StoreController'
        )
        ->name('workers.employers.store');
        
        Route::delete(
            'pracownicy/{worker}/pracodawcy/{employer}',
            'User\Worker\Employer\DestroyController'
        )
        ->name('workers.employers.destroy');
        
        //////////////////////////////////////////////////////////////////////
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
