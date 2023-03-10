<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::post('/auth', [AuthController::class, 'auth']);

Route::prefix('/products')
    ->controller(ProductController::class)
    ->group(function () {
        Route::middleware('auth:api')->post('', 'create');
        Route::middleware('auth:api')->get('', 'list');
        Route::middleware('auth:api')->get('/{id}', 'view');
    });
