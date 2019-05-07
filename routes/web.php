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
        
        // worker/employer

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
        
        // worker/event
        
        Route::get(
            'pracownicy/{worker}/wydarzenia',
            'User\Worker\Event\IndexController'
        )
        ->name('workers.events.index');

        Route::post(
            'pracownicy/{worker}/wydarzenia',
            'User\Worker\Event\StoreController'
        )
        ->name('workers.events.store');
        
        Route::get(
            'pracownicy/{worker}/wydarzenia/utworz',
            'User\Worker\Event\CreateController'
        )
        ->name('workers.events.create');
        
        Route::get(
            'pracownicy/{worker}/wydarzenia/{event}',
            'User\Worker\Event\ShowController'
        )
        ->name('workers.events.show');

        Route::put(
            'pracownicy/{worker}/wydarzenia/{event}',
            'User\Worker\Event\UpdateController'
        )
        ->name('workers.events.update');

        Route::delete(
            'pracownicy/{worker}/wydarzenia/{event}',
            'User\Worker\Event\DestroyController'
        )
        ->name('workers.events.destroy');

        Route::get(
            'pracownicy/{worker}/wydarzenia/{event}/edytuj',
            'User\Worker\Event\EditController'
        )
        ->name('workers.events.edit');

        Route::get(
            'pracownicy/{worker}/ewidencja/{year_month}',
            'User\Worker\Record\IndexController'
        )
        ->name('workers.records.index');

        // legend ////////////////////////////////////////////////////////////
        Route::get(
            'legenda',
            'Calendar\Legend\IndexController'
        )
        ->name('legends.index');
        
        Route::post(
            'legenda',
            'Calendar\Legend\StoreController'
        )
        ->name('legends.store');

        Route::get(
            'legenda/utworz',
            'Calendar\Legend\CreateController'
        )
        ->name('legends.create');

        Route::get(
            'legenda/{legend}',
            'Calendar\Legend\ShowController'
        )
        ->name('legends.show');

        Route::put(
            'legenda/{legend}',
            'Calendar\Legend\UpdateController'
        )
        ->name('legends.update');

        Route::delete(
            'legenda/{legend}',
            'Calendar\Legend\DestroyController'
        )
        ->name('legends.destroy');
        
        Route::get(
            'legenda/{legend}/edytuj',
            'Calendar\Legend\EditController'
        )
        ->name('legends.edit');
        
        // event /////////////////////////////////////////////////////////////
        Route::get(
            'wydarzenia',
            'Calendar\Event\IndexController'
        )
        ->name('events.index');

        Route::post(
            'wydarzenia',
            'Calendar\Event\StoreController'
        )
        ->name('events.store');

        Route::get(
            'wydarzenia/utworz',
            'Calendar\Event\CreateController'
        )
        ->name('events.create');

        Route::get(
            'wydarzenia/{event}',
            'Calendar\Event\ShowController'
        )
        ->name('events.show');

        Route::put(
            'wydarzenia/{event}',
            'Calendar\Event\UpdateController'
        )
        ->name('events.update');

        Route::delete(
            'wydarzenia/{event}',
            'Calendar\Event\DestroyController'
        )
        ->name('events.destroy');

        Route::get(
            'wydarzenia/{event}/edytuj',
            'Calendar\Event\EditController'
        )
        ->name('events.edit');

        // public holiday ////////////////////////////////////////////////////
        Route::get(
            'wolne',
            'Calendar\PublicHoliday\IndexController'
        )
        ->name('holidays.index');
        
        Route::get(
            'wolne/{year}',
            'Calendar\PublicHoliday\ShowController'
        )
        ->name('holidays.show');
    }
);
