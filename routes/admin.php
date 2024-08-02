<?php

use App\Http\Controllers\Admin\MovieController;
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
    Route::get('/{id}/edit', [MovieController::class, 'edit'])->name('edit');
    Route::patch('/{id}/update', [MovieController::class, 'update'])->name('update');
    Route::delete('/{id}/destroy', [MovieController::class, 'destroy'])->name('destroy');
});
