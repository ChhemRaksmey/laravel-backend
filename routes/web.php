<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use App\Http\Controllers\aml\conAmlRiskLevel;
use App\Http\Controllers\aml\conAmlRiskCountries;
use App\Http\Controllers\aml\conAmlResources;
use App\Http\Controllers\aml\conAmlSanctionOnboard;
use App\Http\Controllers\aml\conAmlSanctionWatchList;


Route::resource('users', UserController::class);


Route::get('/', function () { return view('welcome'); });


Route::prefix('aml')
    ->name('aml')
    ->group(function () {

        Route::prefix('risk-countries')
            ->name('_risk_countries')
            ->controller(conAmlRiskCountries::class)
            ->group(function () {
                Route::get('/',  'submit');
                Route::post('/', 'submit');
            })
        ;

        Route::prefix('risk-level')
            ->name('_risk_level')
            ->controller(conAmlRiskLevel::class)
            ->group(function () {
                Route::get('/',  'submit');
                Route::post('/', 'submit');
            })
        ;

        Route::prefix('resources')
            ->name('_resources')
            ->controller(conAmlResources::class)
            ->group(function () {
                Route::get('/',  'submit');
                Route::post('/', 'submit');
            })
        ;

        Route::prefix('sanction')
            ->name('_sanction')
            ->group(function () {

                Route::prefix('onboard')
                    ->name('_onboard')
                    ->controller(conAmlSanctionOnboard::class)
                    ->group(function () {
                        Route::get('/',  'submit');
                        Route::post('/', 'submit');
                    })
                ;

                Route::prefix('watchlist')
                    ->name('_watchlist')
                    ->controller(conAmlSanctionWatchList::class)
                    ->group(function () {
                        Route::get('/',  'submit');
                        Route::post('/', 'submit');
                    })
                ;

            })
        ;

    })
;



