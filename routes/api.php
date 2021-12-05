<?php

use App\Http\Controllers\API\MasterDataController;
use Illuminate\Support\Facades\Route;

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

Route::name('api.')
    ->group(function () {
        Route::name('master-data.')
            ->prefix('master-data')
            ->group(function () {
                Route::get('/items', [MasterDataController::class, 'items'])->name('items');

                Route::get('/customers', [MasterDataController::class, 'customers'])->name('customers');
                Route::get('/customers/{customer}', [MasterDataController::class, 'showCustomer'])->name('customers.show');

                Route::get('/transactions', [MasterDataController::class, 'transactions'])->name('transactions');
            });
    });

