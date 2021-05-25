<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getHello', function (Request $request) {return "hello world";});

Route::get('users', function (Request $request) {
    return response()->json(User::all());
});

Route::post('getCurrentUser', [AuthController::class, 'getCurrentUser']);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);