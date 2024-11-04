<?php


use App\Http\Controllers\Admin\AddsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\LoginGoogleController;
use App\Http\Controllers\AuthenticateController;
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
    return view('welcome');
});
Route::get('/login',[AuthenticateController::class,'showLogin'])->name('showLogin');
Route::post('/login',[AuthenticateController::class,'login'])->name('login');

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth.admin'])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::prefix('category')
            ->as('category.')
            ->group(function () {
                Route::get('/', [CategoryController::class, 'index'])->name('index');
                Route::get('/create', [CategoryController::class, 'create'])->name('create');
                Route::post('/store', [CategoryController::class, 'store'])->name('store');
                Route::get('/{slug}/edit', [CategoryController::class, 'edit'])->name('edit');
                Route::put('/{slug}/update', [CategoryController::class, 'update'])->name('update');
                Route::delete('/{slug}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('post')
            ->as('post.')
            ->group(function () {
                Route::get('/', [PostController::class, 'index'])->name('index');
                Route::get('/create', [PostController::class, 'create'])->name('create');
                Route::post('/store', [PostController::class, 'store'])->name('store');
                Route::get('/{slug}/edit', [PostController::class, 'edit'])->name('edit');
                Route::put('/{slug}/update', [PostController::class, 'update'])->name('update');
                Route::delete('/{slug}/destroy', [PostController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('user')
            ->as('user.')
            ->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/create', [UserController::class, 'create'])->name('create');
                Route::post('/store', [UserController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
                Route::put('/{id}/update', [UserController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('adss')
            ->as('adss.')
            ->group(function () {
                Route::get('/', [AddsController::class, 'index'])->name('index');
                Route::get('/create', [AddsController::class, 'create'])->name('create');
                Route::post('/store', [AddsController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [AddsController::class, 'edit'])->name('edit');
                Route::put('/{id}/update', [AddsController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [AddsController::class, 'destroy'])->name('destroy');
            });

    });
    Route::controller(LoginGoogleController::class)->group(function () {
        Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
        Route::get('auth/google/callback', 'handleGoogleCallback');
    });


