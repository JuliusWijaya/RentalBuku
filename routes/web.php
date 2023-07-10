<?php

use App\Http\Controllers\AuthenticatingController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RentLogController;
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
    Route::post('login', [AuthenticatingController::class, 'authenticate'])->name('authenticate');
    Route::get('register', [AuthenticatingController::class, 'register']);
    Route::post('register', [AuthenticatingController::class, 'registerAction'])->name('registerAction');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->middleware('only_admin');
    Route::get('profile', [UserController::class, 'index'])->middleware('only_client');

    Route::resource('books', BookController::class);
    Route::get('/books/{slug}/edit', [BookController::class, 'edit']);

    Route::resource('categories', CategoryController::class);
    Route::get('/categories/{slug}/edit', [CategoryController::class, 'edit']);
    Route::get('/category/list-delete', [CategoryController::class, 'deleteCategory']);
    Route::get('/category/{slug}/restore', [CategoryController::class, 'restore']);

    Route::get('users', [UserController::class, 'index']);
    Route::get('rent-logs', [RentLogController::class, 'index']);
    Route::get('logout', [AuthenticatingController::class, 'logout'])->name('logout');
});
