<?php

use App\Http\Controllers\Tasks\CreateController;
use App\Http\Controllers\Tasks\ListController;
use App\Http\Controllers\Tasks\StatisticsController;
use App\Http\Controllers\Users\LoginController;
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

Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get("/login", [LoginController::class, 'show'])->name('login');
Route::post("/login", [LoginController::class, 'login'])->name('login.post');

// Logged In
Route::group(['middleware' => 'auth', 'prefix' => '/tasks'], function () {
    Route::get('/', [ListController::class, 'index'])->name('tasks.list');
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('tasks.statistics');

    // only admin can create tasks
    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/create', [CreateController::class, 'show'])->name('tasks.create');
        Route::post('/store', [CreateController::class, 'store'])->name('tasks.store');
    });
});
