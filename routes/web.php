<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\fas\conFasAccount;
use App\Http\Controllers\fas\conFasModel;
use App\Http\Controllers\fas\conFasSupplier;
use App\Http\Controllers\fas\conFasGDTAccount;
use App\Http\Controllers\fas\conFasGDTExchange;
use App\Http\Controllers\fas\conFasGDTAsset;

use App\Http\Controllers\fas\conFasRecived;
use App\Http\Controllers\fas\conFasBooking;
use App\Http\Controllers\fas\conFasTransfer;
use App\Http\Controllers\fas\conFasDisposal;
use App\Http\Controllers\fas\conFasReverse;
use App\Http\Controllers\fas\conFasToInventory;


use App\Http\Controllers\UserController;

Route::resource('users', UserController::class);


Route::get('/', function () { return view('welcome'); });


Route::prefix('fas')
    ->name('fas')
    ->group(function () {

        Route::prefix('accounts')
            ->name('_accounts_')
            ->controller(conFasAccount::class)
            ->group(function () {

                Route::get('/list',      'pgae_list')->name('list');
                Route::get('/create',    'pgae_create')->name('create');
                Route::get('/edit',      'pgae_edit')->name('edit');
                Route::get('/view',      'pgae_view')->name('view');
                Route::get('/authorize', 'pgae_authorize')->name('authorize');

                Route::post('/create',    'save_create')->name('create');
                Route::post('/edit',      'save_edit')->name('edit');
                Route::post('/authorize', 'save_authorize')->name('authorize');
                Route::post('/cancel',    'save_cancel')->name('cancel');

            })
        ;

        Route::prefix('models')
            ->name('_models_')
            ->controller(conFasModel::class)
            ->group(function () {

                Route::get('/list',      'pgae_list')->name('list');
                Route::get('/create',    'pgae_create')->name('create');
                Route::get('/edit',      'pgae_edit')->name('edit');
                Route::get('/view',      'pgae_view')->name('view');
                Route::get('/authorize', 'pgae_authorize')->name('authorize');

                Route::post('/create',    'save_create')->name('create');
                Route::post('/edit',      'save_edit')->name('edit');
                Route::post('/authorize', 'save_authorize')->name('authorize');
                Route::post('/cancel',    'save_cancel')->name('cancel');

            })
        ;

        Route::prefix('suppliers')
            ->name('_supplier_')
            ->controller(conFasSupplier::class)
            ->group(function () {

                Route::get('/list',      'pgae_list')->name('list');
                Route::get('/create',    'pgae_create')->name('create');
                Route::get('/edit',      'pgae_edit')->name('edit');
                Route::get('/view',      'pgae_view')->name('view');
                Route::get('/authorize', 'pgae_authorize')->name('authorize');

                Route::post('/create',    'save_create')->name('create');
                Route::post('/edit',      'save_edit')->name('edit');
                Route::post('/authorize', 'save_authorize')->name('authorize');
                Route::post('/cancel',    'save_cancel')->name('cancel');

            })
        ;

        Route::prefix('gdt/account')
            ->name('_gdt_account_')
            ->controller(conFasGDTAccount::class)
            ->group(function () {

                Route::get('/list',      'pgae_list')->name('list');
                Route::get('/edit',      'pgae_edit')->name('edit');
                Route::get('/view',      'pgae_view')->name('view');
                Route::get('/authorize', 'pgae_authorize')->name('authorize');

                Route::post('/edit',      'save_edit')->name('edit');
                Route::post('/authorize', 'save_authorize')->name('authorize');
                Route::post('/cancel',    'save_cancel')->name('cancel');

            })
        ;

        Route::prefix('gdt/exchange')
            ->name('_gdt_exchange_')
            ->controller(conFasGDTExchange::class)
            ->group(function () {

                Route::get('/list',      'pgae_list')->name('list');
                Route::get('/create',    'pgae_create')->name('create');
                Route::get('/edit',      'pgae_edit')->name('edit');
                Route::get('/view',      'pgae_view')->name('view');
                Route::get('/authorize', 'pgae_authorize')->name('authorize');

                Route::post('/create',    'save_create')->name('create');
                Route::post('/edit',      'save_edit')->name('edit');
                Route::post('/authorize', 'save_authorize')->name('authorize');
                Route::post('/cancel',    'save_cancel')->name('cancel');

            })
        ;

        Route::prefix('gdt/asset')
            ->name('_gdt_asset_')
            ->controller(conFasGDTAsset::class)
            ->group(function () {

                Route::get('/list',      'pgae_list')->name('list');
                Route::get('/edit',      'pgae_edit')->name('edit');
                Route::get('/view',      'pgae_view')->name('view');
                Route::get('/authorize', 'pgae_authorize')->name('authorize');

                Route::post('/edit',      'save_edit')->name('edit');
                Route::post('/authorize', 'save_authorize')->name('authorize');
                Route::post('/cancel',    'save_cancel')->name('cancel');

            })
        ;

        

        Route::prefix('recived')
            ->name('_recived_')
            ->controller(conFasRecived::class)
            ->group(function () {

                Route::get('/list',      'pgae_list')->name('list');
                Route::get('/create',    'pgae_create')->name('create');
                Route::get('/edit',      'pgae_edit')->name('edit');
                Route::get('/view',      'pgae_view')->name('view');
                Route::get('/authorize', 'pgae_authorize')->name('authorize');

                Route::post('/create',    'save_create')->name('create');
                Route::post('/edit',      'save_edit')->name('edit');
                Route::post('/authorize', 'save_authorize')->name('authorize');
                Route::post('/cancel',    'save_cancel')->name('cancel');

            })
        ;

        Route::prefix('booking')
            ->name('_booking_')
            ->controller(conFasBooking::class)
            ->group(function () {

                Route::get('/list',      'pgae_list')->name('list');
                Route::get('/create',    'pgae_create')->name('create');
                Route::get('/edit',      'pgae_edit')->name('edit');
                Route::get('/view',      'pgae_view')->name('view');
                Route::get('/authorize', 'pgae_authorize')->name('authorize');

                Route::post('/create',    'save_create')->name('create');
                Route::post('/edit',      'save_edit')->name('edit');
                Route::post('/authorize', 'save_authorize')->name('authorize');
                Route::post('/cancel',    'save_cancel')->name('cancel');

            })
        ;

        Route::prefix('transfer')
            ->name('_transfer_')
            ->controller(conFasTransfer::class)
            ->group(function () {

                Route::get('/list',      'pgae_list')->name('list');
                Route::get('/create',    'pgae_create')->name('create');
                Route::get('/edit',      'pgae_edit')->name('edit');
                Route::get('/view',      'pgae_view')->name('view');
                Route::get('/authorize', 'pgae_authorize')->name('authorize');

                Route::post('/create',    'save_create')->name('create');
                Route::post('/edit',      'save_edit')->name('edit');
                Route::post('/authorize', 'save_authorize')->name('authorize');
                Route::post('/cancel',    'save_cancel')->name('cancel');

            })
        ;

        Route::prefix('disposal')
            ->name('_disposal_')
            ->controller(conFasDisposal::class)
            ->group(function () {

                Route::get('/list',      'pgae_list')->name('list');
                Route::get('/create',    'pgae_create')->name('create');
                Route::get('/edit',      'pgae_edit')->name('edit');
                Route::get('/view',      'pgae_view')->name('view');
                Route::get('/authorize', 'pgae_authorize')->name('authorize');

                Route::post('/create',    'save_create')->name('create');
                Route::post('/edit',      'save_edit')->name('edit');
                Route::post('/authorize', 'save_authorize')->name('authorize');
                Route::post('/cancel',    'save_cancel')->name('cancel');

            })
        ;

        Route::prefix('reverse')
            ->name('_reverse_')
            ->controller(conFasReverse::class)
            ->group(function () {

                Route::get('/list',      'pgae_list')->name('list');
                Route::get('/create',    'pgae_create')->name('create');
                Route::get('/edit',      'pgae_edit')->name('edit');
                Route::get('/view',      'pgae_view')->name('view');
                Route::get('/authorize', 'pgae_authorize')->name('authorize');

                Route::post('/create',    'save_create')->name('create');
                Route::post('/edit',      'save_edit')->name('edit');
                Route::post('/authorize', 'save_authorize')->name('authorize');
                Route::post('/cancel',    'save_cancel')->name('cancel');

            })
        ;

        Route::prefix('to-innventory')
            ->name('_to_inventory_')
            ->controller(conFasToInventory::class)
            ->group(function () {

                Route::get('/list',      'pgae_list')->name('list');
                Route::get('/create',    'pgae_create')->name('create');
                Route::get('/edit',      'pgae_edit')->name('edit');
                Route::get('/view',      'pgae_view')->name('view');
                Route::get('/authorize', 'pgae_authorize')->name('authorize');

                Route::post('/create',    'save_create')->name('create');
                Route::post('/edit',      'save_edit')->name('edit');
                Route::post('/authorize', 'save_authorize')->name('authorize');
                Route::post('/cancel',    'save_cancel')->name('cancel');

            })
        ;

    })
;



