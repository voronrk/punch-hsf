<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PunchController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/machine.add', [MachineController::class, 'store']);
Route::get('/material.add', [MaterialController::class, 'store']);
Route::get('/product.add', [ProductController::class, 'store']);

Route::get('/machine.update', [MachineController::class, 'update']);
Route::get('/material.update', [MaterialController::class, 'update']);
Route::get('/product.update', [ProductController::class, 'update']);

Route::get('/machine.delete', [MachineController::class, 'destroy']);
Route::get('/material.delete', [MaterialController::class, 'destroy']);
Route::get('/product.delete', [ProductController::class, 'destroy']);

Route::apiResources([
    'product' => ProductController::class,
    'machine' => MachineController::class,
    'material' => MaterialController::class,
    'punch' => PunchController::class,
]);

