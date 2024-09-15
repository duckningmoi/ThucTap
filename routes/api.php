<?php

use App\Http\Controllers\Api\ApiPostController;
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
Route::get('/',[ApiPostController::class,'Trangchu'])->name('trangchu');
Route::get('/header',[ApiPostController::class,'category'])->name('abc');
Route::get('/post/{id_category}',[ApiPostController::class,'filterPost'])->name('abc');

