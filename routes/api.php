<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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
Route::prefix('users')->group(function() {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'create']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'delete']);

    Route::prefix('profile')->group(function() {
        Route::get('/{user_id}', [ProfileController::class, 'show']);
        Route::post('/{user_id}', [ProfileController::class, 'create']);
        Route::put('/{user_id}', [ProfileController::class, 'update']);
    });
});

Route::prefix('roles')->group(function() {
    Route::get('/', [RoleController::class, 'index']);
    Route::post('/', [RoleController::class, 'create']);
    Route::put('/{role_id}', [RoleController::class, 'update']);
    Route::put('/{role_id}/user/{user_id}', [RoleController::class, 'addToUser']);
});




