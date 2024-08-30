<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('world/countries', function (){
//    return \App\Models\Country::query()->get();
//});

//Route::prefix('world')->group(function () {
//    Route::get('word/countries', \App\Models\Country::query()->get()->toArray());
//    Route::get('word/cities', \App\Models\City::query()->get()->toArray());
//});
