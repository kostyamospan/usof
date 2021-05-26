<?php

use App\Http\Controllers\PostsController;
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

Route::middleware('jwt')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', function (Request $request) {
    return response()->json(User::all());
});

Route::post('getCurrentUser', [AuthController::class, 'getCurrentUser']);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('posts', [PostsController::class, 'getAllPosts']); // + tested
Route::get('posts/{id}', [PostsController::class, 'getPostById']);// + tested
Route::get('posts/{id}/comments', [PostsController::class, 'getPostComments']);// +
Route::post('posts/{id}/comments', [PostsController::class, 'createNewComment']); // +
Route::get('posts/{id}/categories', [PostsController::class, 'getPostCategories']); // +
Route::get('posts/{id}/likes', [PostsController::class, 'getPostLikes']); // +
Route::post('post', [PostsController::class, 'createNewPost']);// + tested
Route::post('posts/{id}/likes', [PostsController::class, 'setPostLike']); // +
Route::patch('posts/{id}', [PostsController::class, 'updatePost']);
Route::delete('posts/{id}', [PostsController::class, 'deletePost']);// +
Route::delete('posts/{id}/likes', [PostsController::class, 'deletePostLike']);// +









