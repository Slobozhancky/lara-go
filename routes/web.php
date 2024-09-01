<?php


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

use App\Http\Controllers\Post\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/' , [\App\Http\Controllers\HomeController::class , 'index'])->name(('home.index'));
Route::get('/contacts' , [\App\Http\Controllers\HomeController::class , 'contacts'])->name(('home.contacts'));

Route::prefix('posts')->group(function () {
    Route::get('/' , [\App\Http\Controllers\Post\PostController::class , 'index'])->name(('post.index'));
    Route::get('/create' , [\App\Http\Controllers\Post\PostController::class , 'create'])->name(('post.create'));
    Route::post('/' , [\App\Http\Controllers\Post\PostController::class , 'store'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    Route::put('/{id}' , [\App\Http\Controllers\Post\PostController::class , 'update'])->withoutMiddleware
    (\App\Http\Middleware\VerifyCsrfToken::class);
    Route::delete('/{id}' , [\App\Http\Controllers\Post\PostController::class , 'destroy'])->withoutMiddleware
    (\App\Http\Middleware\VerifyCsrfToken::class);
});

Route::prefix('world')->group(function () {
    Route::get('/cities' , [\App\Http\Controllers\World\WorldController::class , 'cities'])->name('world/cities');
    Route::get('/countries' , [\App\Http\Controllers\World\WorldController::class , 'countries'])->name('world/countries');
});

Route::get('catalog/{$id}' , [\App\Http\Controllers\Catalog\Product::class , 'show']);

Route::prefix('catalog')->group(function () {
    Route::get('/', [\App\Http\Controllers\Catalog\Product::class , 'index']);
    Route::get('/{id}', [\App\Http\Controllers\Catalog\Product::class , 'show']);
    Route::get('/{id}/edit' , [\App\Http\Controllers\Catalog\Product::class , 'edit'])->name('catalog/edit');
    Route::get('/category' , [\App\Http\Controllers\Catalog\Category::class , 'index'])->name('catalog/category');
});




