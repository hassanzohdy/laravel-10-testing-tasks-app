<?php

use App\Http\Controllers\Tasks\CreateController;
use App\Http\Controllers\Tasks\ListController;
use App\Http\Controllers\Tasks\StatisticsController;
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

Route::get('/tasks', [ListController::class, 'index'])->name('tasks.list');
Route::get('/tasks/statistics', [StatisticsController::class, 'index'])->name('tasks.statistics');
Route::get('/tasks/create', [CreateController::class, 'show'])->name('tasks.create');
Route::post('/tasks/store', [CreateController::class, 'store'])->name('tasks.store');
