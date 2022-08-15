<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PunchController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::any('/favorites.add', [FavoriteController::class, 'store']);

Route::middleware('auth:api')->group(function () {

    Route::any('/machine.add', [MachineController::class, 'store']);
    Route::any('/material.add', [MaterialController::class, 'store']);
    Route::any('/product.add', [ProductController::class, 'store']);
    Route::any('/punch.add', [PunchController::class, 'store']);
    Route::any('/favorites.add', [FavoriteController::class, 'store']);

    Route::any('/machine.update', [MachineController::class, 'update']);
    Route::any('/material.update', [MaterialController::class, 'update']);
    Route::any('/product.update', [ProductController::class, 'update']);
    Route::any('/punch.update', [PunchController::class, 'update']);

    Route::any('/machine.delete', [MachineController::class, 'destroy']);
    Route::any('/material.delete', [MaterialController::class, 'destroy']);
    Route::any('/product.delete', [ProductController::class, 'destroy']);
    Route::any('/punch.delete', [PunchController::class, 'destroy']);

    Route::any('/machine.get', [MachineController::class, 'show']);
    Route::any('/material.get', [MaterialController::class, 'show']);
    Route::any('/product.get', [ProductController::class, 'show']);
    Route::any('/punch.get', [PunchController::class, 'show']);

    Route::any('/machine.list', [MachineController::class, 'index']);
    Route::any('/material.list', [MaterialController::class, 'index']);
    Route::any('/product.list', [ProductController::class, 'index']);
    Route::any('/punch.list', [PunchController::class, 'index']);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');