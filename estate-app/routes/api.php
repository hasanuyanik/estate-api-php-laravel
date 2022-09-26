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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::controller(AuthController::class)->post('register', function(Request $request){
    $user = User::create([
        'name' => 'Hasan UYANIK',
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);

    return response()->json([
        'message' => 'Created',
        'user' => $user
    ]);
});

Route::controller(AuthController::class)->middleware('api')->group(function ($router) {
   // Route::post('register', 'AuthController@register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('me', 'me');
});

Route::prefix('appointment')->controller(AppointmentController::class)->middleware('api')->group(function ($router) {
    Route::post('/create', 'create');
    Route::post('/update', 'update');
    Route::get('/delete/{id}', 'delete');
    Route::post('/list', 'list');
});