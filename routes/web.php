<?php

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

Route::prefix('admin')->group(function (){
    Route::get('/', function () {
        return "Admin main page";
    });

    Route::get('/posts', function () {
        return "Admin page, for all posts";
    });

    Route::get('/posts/{id}', function ($id) {
        return "Admin post {$id}";
    });
});

Route::get('test', [\App\Http\Controllers\TestController::class,  'index']);

Route::fallback(function (){
    abort(404, "This is 404 page");
});


