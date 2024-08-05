<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Movie\Schedule\Reservation\ReservationController;
use App\Http\Controllers\Movie\Schedule\Sheet\SheetController as MovieScheduleSheetController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;
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
    Route::get('users/create', function () {
        return view('front.user.create');
    })->name('users.create');

    Route::get('login', function () {
        return view('front.user.login');
    })->name('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => 'movies', 'as' => 'movies.'], function () {
    Route::get('/', [MovieController::class, 'index'])->name('index');
    Route::get('/{id}', [MovieController::class, 'show'])->name('show');
});

Route::group(['prefix' => 'sheets', 'as' => 'sheets.'], function () {
    Route::get('/', [SheetController::class, 'index'])->name('index');
});

Route::group(['prefix' => 'movies/{movieId}/schedules/{scheduleId}/sheets', 'as' => 'movies.schedules.sheets.'], function () {
    Route::get('/', [MovieScheduleSheetController::class, 'index'])->name('index');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');

    Route::group(['prefix' => 'movies/{movieId}/schedules/{scheduleId}/sheets', 'as' => 'movies.schedules.sheets.'], function () {
        Route::get('/{sheetId}/reserve', [MovieScheduleSheetController::class, 'reserve'])->name('reserve');
    });

    Route::group(['prefix' => 'movies/{movieId}/schedules/{scheduleId}/reservations', 'as' => 'reservations.'], function () {
        Route::get('/create', [ReservationController::class, 'create'])->name('create');
    });

    Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');
});

require __DIR__ . '/auth.php';
