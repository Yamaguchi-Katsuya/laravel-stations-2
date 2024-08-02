<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\PracticeController;
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

Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);

Route::get('/getPractice', [PracticeController::class, 'getPractice']);

Route::group(['prefix' => 'movies', 'as' => 'movies.'], function () {
    Route::get('/', [MovieController::class, 'index'])->name('index');
});

Route::group(['prefix' => 'sheets', 'as' => 'sheets.'], function () {
    Route::get('/', [SheetController::class, 'index'])->name('index');
});
