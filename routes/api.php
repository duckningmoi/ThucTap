<?php

use App\Http\Controllers\Api\ApiAuthenticateController;
use App\Http\Controllers\Api\ApiPostController;

use App\Http\Controllers\Api\LoginGoogleController;
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
Route::get('/posts',[ApiPostController::class,'Trangchu'])->name('trangchu');
Route::get('/category',[ApiPostController::class,'category'])->name('abc');
Route::get('/post/{id_category}',[ApiPostController::class,'filterPost'])->name('abc');
Route::get('/search-posts', [ApiPostController::class, 'searchPosts']);
Route::get('/postDetail/{slug}',[ApiPostController::class,'PostDetail']);
Route::post('login',[ApiAuthenticateController::class,'login']);
Route::post('register',[ApiAuthenticateController::class,'register']);
Route::post('logout',[ApiAuthenticateController::class,'logout'])->middleware('auth:sanctum');
Route::post('/comments/{slug}', [ApiPostController::class, 'PostComment']);
Route::post('register',[ApiAuthenticateController::class,'register']);
Route::get('/account/{google_id}',[LoginGoogleController::class,'googleDetail']);

// login by google 
Route::middleware(['web'])->group(function () {
    Route::controller(LoginGoogleController::class)->group(function () {
        Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
        Route::get('auth/google/callback', 'handleGoogleCallback');
    });
});



