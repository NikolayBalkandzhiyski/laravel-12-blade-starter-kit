<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('login', [LoginController::class, 'store']);

    Route::get('register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('logout', [LogoutController::class, 'store'])
        ->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'create'])
                ->name('login');

    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);

    Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'create'])
                ->name('register');

    Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])
                ->name('dashboard');

    Route::post('logout', [\App\Http\Controllers\Auth\LogoutController::class, 'store'])
                ->name('logout');
});