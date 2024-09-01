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

Route::prefix('world')->group(function () {
    Route::get('/cities' , [\App\Http\Controllers\World\WorldController::class , 'cities'])->name('world/cities');
    Route::get('/countries' , [\App\Http\Controllers\World\WorldController::class , 'countries'])->name('world/countries');
});

Route::prefix('authors')->group(function (){
   Route::get('/', [\App\Http\Controllers\Author\Author::class, 'index']);
});



