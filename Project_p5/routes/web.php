<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ArticleController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('user',App\Http\Controllers\UserController::class)->middleware('auth');
Route::resource('categorie',App\Http\Controllers\CategorieController::class)->middleware('auth');
Route::resource('article',App\Http\Controllers\ArticleController::class)->middleware('auth');

Route::get('/categorie', [CategorieController::class, 'index'])->name('categorie.index');
Route::get('/categorie/create', [CategorieController::class, 'create'])->name('categorie.create');
Route::post('/categorie', [CategorieController::class, 'store'])->name('categorie.store');
Route::get('/categorie/{id}/edit', [CategorieController::class, 'edit'])->name('categorie.edit');
Route::put('/categorie/{id}', [CategorieController::class, 'update'])->name('categorie.update');
Route::delete('/categorie/{id}', [CategorieController::class, 'destroy'])->name('categorie.destroy');
Route::get('/categories/{id}', [CategorieController::class, 'show'])->name('categorie.show');

Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
Route::post('/article', [ArticleController::class, 'store'])->name('article.store');
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/article/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
Route::put('/article/{id}', [ArticleController::class, 'update'])->name('article.update');
Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');