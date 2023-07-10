<?php

use App\Http\Controllers\FilmsController;
use App\Http\Controllers\GenreController;
use App\Models\Genre;
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

Route::get('/', [FilmsController::class, "show"])->name("film.show");

Route::get('/films/add', [FilmsController::class, "add"])->name("film.add");
Route::get('/films/remove/{id}', [FilmsController::class, "remove"])->name("film.remove");
Route::get('/films/find/{id}', [FilmsController::class, "find"])->name("film.find");
Route::get('/films/status/{id}/{status}', [FilmsController::class, "status"])->name("film.status");
Route::get('/films/edit/{id}', [FilmsController::class, "edit"])->name("film.edit");
Route::post('/films/edit/check', [FilmsController::class, "editcheck"])->name("film.editcheck");
Route::post('/films/check', [FilmsController::class, "check"])->name("film.check");

Route::get('/genres', [\App\Http\Controllers\GenreController::class, "show"])->name("genre.show");
Route::get('/genres/add', [\App\Http\Controllers\GenreController::class, "add"])->name("genre.add");
Route::post('/genres/check', [\App\Http\Controllers\GenreController::class, "check"])->name("genre.check");
Route::get('/genres/remove/{id}', [GenreController::class, "remove"])->name("genre.remove");