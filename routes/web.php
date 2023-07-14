<?php

use App\Http\Controllers\AuthenticatingController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PagesController::class, 'index']);
Route::get('/about', [PagesController::class, 'about']);
Route::get('/list-books', [PagesController::class, 'listBook']);

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatingController::class, 'login'])->name('login');
    Route::post('login', [AuthenticatingController::class, 'authenticate'])->name('authenticate');
    Route::get('register', [AuthenticatingController::class, 'register']);
    Route::post('register', [AuthenticatingController::class, 'registerAction'])->name('registerAction');
});

Route::middleware('auth')->group(function () {
    Route::get('profile', [UserController::class, 'profile'])->middleware('only_client');

    Route::middleware('only_admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::resource('books', BookController::class);
        Route::get('/books/{slug}/edit', [BookController::class, 'edit']);
        Route::get('/book/list-delete', [BookController::class, 'deleteBook']);
        Route::get('/book/{slug}/restore', [BookController::class, 'restoreBook']);

        Route::resource('categories', CategoryController::class);
        Route::get('/categories/{slug}/edit', [CategoryController::class, 'edit']);
        Route::get('/category/list-delete', [CategoryController::class, 'deleteCategory']);
        Route::get('/category/{slug}/restore', [CategoryController::class, 'restore']);

        Route::get('users', [UserController::class, 'index']);
        Route::get('/users/active-user', [UserController::class, 'active']);
        Route::get('/users/{slug}/detail', [UserController::class, 'show']);
        Route::get('/users/{slug}/approve', [UserController::class, 'update']);
        Route::delete('/users/{slug}/delete', [UserController::class, 'destroy']);
        Route::get('/users/list-delete', [UserController::class, 'deleteUser']);
        Route::get('/users/{slug}/restore', [UserController::class, 'restore']);

        Route::get('rent-logs', [RentLogController::class, 'index']);
    });

    Route::get('logout', [AuthenticatingController::class, 'logout'])->name('logout');
});
