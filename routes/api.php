<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller (UserController::class) -> group (function () {
    Route::post('register', 'register');
    Route::get('login', 'loginCheck') -> name('login');
    Route::post('login', 'login');
});

Route::middleware(['auth:api']) -> group (function () {
    Route::get('logout', [UserController::class, 'logout']);

    Route::controller (FoodController::class) -> group (function () {
        Route::prefix('/food') -> group (function () {
            Route::post('create', 'create');
            Route::get('read', 'read');
            Route::post('update/{food}', 'update');
            Route::get('delete/{food}', 'delete');
        });
    });
});