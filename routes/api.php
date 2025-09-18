<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Firebase Authentication Routes
Route::post('/firebase/login', [App\Http\Controllers\FirebaseAuthController::class, 'login']);
Route::post('/firebase/verify', [App\Http\Controllers\FirebaseAuthController::class, 'verifyToken']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/firebase/logout', [App\Http\Controllers\FirebaseAuthController::class, 'logout']);
});
