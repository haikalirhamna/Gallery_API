<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('guest')->group(function () {
    Route::prefix('user')->group(function() {
        Route::post('register', [UserController::class, 'register']);
        Route::post('login', [UserController::class, 'login']);
    });
    Route::prefix('admin')->group(function() {
        Route::post('register', [AdminController::class, 'register']);
        Route::post('login', [AdminController::class, 'login']);
    });

});

Route::middleware('auth:admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('update', [AdminController::class, 'update']);
    });
});

Route::middleware('auth:user')->group(function () {
    Route::prefix('user')->group(function() {
        Route::post('update', [UserController::class, 'update']);
    });

    Route::prefix('album')->group(function() {
        Route::get('/{album}', [AlbumController::class, 'show']);
        Route::get('/', [AlbumController::class, 'showAll']);
        Route::post('/', [AlbumController::class, 'store']);
        Route::post('/{album}', [AlbumController::class, 'update']);
        Route::delete('/{album}', [AlbumController::class, 'delete']);
        Route::delete('/', [AlbumController::class, 'deleteAll']);
    });

    Route::prefix('photo')->group(function() {
        Route::get('/{photo}', [PhotoController::class, 'show']);
        Route::post('/', [PhotoController::class, 'store']);
        Route::post('/{photo}', [PhotoController::class, 'update']);
        Route::delete('/{photo}', [PhotoController::class, 'delete']);
    });
});