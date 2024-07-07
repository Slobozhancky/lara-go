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

Route::get('/', function () {
    return view();
});

Route::get('test', function (){
   return view('test', ['title'  => "Тестова сторінка"]);
});

Route::view('/static-page', 'static-page', ['title'  => "Тестова сторінка"]);

Route::get('post/{id}', function ($id){
    return "Post: {$id}";
})->where(['id' => '[\d]+']);


Route::get('post/{id}/comment/{comment_id}', function ($id, $comment_id){
    return "Post: {$id}; Comment: {$comment_id}";
});

Route::get('posts', function (){
    return "Hello this is method GET, of posts page";
});

Route::post('posts', function (){
    return "Hello this is method POST, of posts page";
})->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);


Route::match(['get', 'post'],'get-posts', function (){
    return "Hello this is method GET|POST, of posts page";
})->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

Route::any('get-posts', function (){
    return "Hello this is method ANY, of posts page";
})->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);


Route::redirect('here', 'get-posts', 302);
