<?php

use App\Http\Controllers\AuthenticatingController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatingController::class, 'login'])->name('login');
    Route::post('login', [AuthenticatingController::class, 'authenticate']);
    Route::get('register', [AuthenticatingController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->middleware('only_admin');
    Route::get('profile', [UserController::class, 'index'])->middleware('only_client');
    Route::get('books', [BookController::class, 'index']);
    Route::get('logout', [AuthenticatingController::class, 'logout']);
});