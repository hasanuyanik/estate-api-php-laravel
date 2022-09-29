<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Models\User;
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

Route::controller(AuthController::class)->middleware('api')->group(function ($router) {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('me', 'me');
});

Route::prefix('appointment')->controller(AppointmentController::class)->middleware('api')->group(function ($router) {
    Route::post('/create', 'create');
    Route::post('/update/{id}', 'update');
    Route::get('/delete/{id}', 'delete');
    Route::post('/list', 'list');
});