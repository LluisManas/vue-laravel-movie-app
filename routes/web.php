<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('/home-page', [HomeController::class, 'index'])->name('home');

//User Settings
Route::get('/api/user', [UserController::class, 'getUserDetails']);
Route::get('/api/countries-list', [UserController::class, 'getCountriesList']);
Route::post('/api/update-country', [UserController::class, 'updateStreamingCountry']);

//Movie
Route::get('/api/popular-movies', [MoviesController::class, 'popularMovies']);
Route::get('/api/top-rated-movies', [MoviesController::class, 'topRatedMovies']);
Route::get('/api/movie/{id}', [MoviesController::class, 'detailsMovie']);
Route::get('/api/movie/{id}/similar', [MoviesController::class, 'similarMovies']);
Route::get('/api/search-movie/{name}', [MoviesController::class, 'searchMovie']);

//Movie lists
Route::get('/api/lists', [ListController::class, 'showLists']);
Route::post('/api/create-list', [ListController::class, 'createList']);
Route::post('/api/add-movie-to-list/{id}', [ListController::class, 'addMovieToList']);
Route::get('/api/get-movies-from-list/{id}', [ListController::class, 'getMoviesFromList']);
Route::get('/api/delete-list/{id}', [ListController::class, 'deleteList']);
Route::get('/api/list/{listId}/movie/{movieId}/delete', [ListController::class, "deleteMovieFromList"]);

Route::any('{slug}', function () {
    return view('home');
});
