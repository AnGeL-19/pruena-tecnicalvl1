<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoritesController;

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
    return view('search.index');
});

Route::get('/favorites', function () {
    return view('favorites.index');
});

Route::get('/favorites', [FavoritesController::class,'index'])->name('favorites');

Route::post('/', [FavoritesController::class,'store'])->name('favorites');

Route::delete('/favorites/{id}', [FavoritesController::class,'destroy'])->name('character-destroy');
