<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TinyUploadController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
    Route::post('tiny-image-upload', [TinyUploadController::class, 'uploadImage']);
    Route::post('filepond-image-upload', [FilePondUploadController::class, 'uploadImage']);

    Route::get('/datatable', function () {
        return view('example.datatable');
    });

    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::group(['middleware' => 'role:first_role,second_role'], function () {
        // masukin route disini cuy
    });

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {

        Route::group(['middleware' => 'role:admin'], function () {
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('store', [UserController::class, 'store'])->name('store');
            Route::delete('destroy/{user}', [UserController::class, 'destroy'])->name('destroy');
        });

        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('edit');
        Route::patch('update/{user}', [UserController::class, 'update'])->name('update');
        Route::get('datatable', [UserController::class, 'datatable'])->name('datatable');
    });

});
