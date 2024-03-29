<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
});
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::get('/users', [UserController::class, 'index']);           // List all users
Route::post('/users', [UserController::class, 'store']);          // Create a new user
Route::get('/users/{user}', [UserController::class, 'show']);     // Get a specific user
Route::put('/users/{user}', [UserController::class, 'update']);   // Update a specific user
Route::delete('/users/{user}', [UserController::class, 'destroy']); // Delete a specific user




Route::get('/cars', [CarController::class, 'index']);
Route::post('/estimateprix', [CarController::class, 'estimateprix']);
