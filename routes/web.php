<?php

use App\Http\Controllers\API\MasterDataController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('items', ItemController::class)->except('show');
    Route::resource('customers', CustomerController::class)->except(['create', 'edit']);

    Route::prefix('transactions')
        ->name('transactions.')
        ->group(function () {
            Route::get('/{transaction}/input-order', [OrderController::class, 'create'])->name('order.create');
            Route::post('/{transaction}/store-order', [OrderController::class, 'store'])->name('order.store');
            Route::delete('/delete-order/{order}', [OrderController::class, 'destroy'])->name('order.delete');
        });

    Route::resource('transactions', TransactionController::class)->except(['create']);
});
