<?php

use App\Http\Controllers\Admin\Movie\MovieController;
use App\Http\Controllers\Admin\Movie\Schedule\ScheduleController as MovieScheduleController;
use App\Http\Controllers\Admin\Reservation\ReservationController;
use App\Http\Controllers\Admin\Schedule\ScheduleController;
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

Route::group(['prefix' => 'movies', 'as' => 'movies.'], function () {
    Route::get('/', [MovieController::class, 'index'])->name('index');
    Route::get('/create', [MovieController::class, 'create'])->name('create');
    Route::post('/store', [MovieController::class, 'store'])->name('store');
    Route::get('/{id}', [MovieController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [MovieController::class, 'edit'])->name('edit');
    Route::patch('/{id}/update', [MovieController::class, 'update'])->name('update');
    Route::delete('/{id}/destroy', [MovieController::class, 'destroy'])->name('destroy');

    Route::group(['prefix' => '{id}/schedules', 'as' => 'schedules.'], function () {
        Route::get('/create', [MovieScheduleController::class, 'create'])->name('create');
        Route::post('/store', [MovieScheduleController::class, 'store'])->name('store');
    });
});

Route::group(['prefix' => 'schedules', 'as' => 'schedules.'], function () {
    Route::get('/', [ScheduleController::class, 'index'])->name('index');
    Route::get('/{id}/edit', [ScheduleController::class, 'edit'])->name('edit');
    Route::patch('/{id}/update', [ScheduleController::class, 'update'])->name('update');
    Route::delete('/{id}/destroy', [ScheduleController::class, 'destroy'])->name('destroy');
});

Route::resources([
    'reservations' => ReservationController::class,
]);
