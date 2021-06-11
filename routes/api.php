<?php

use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentsController;

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

Route::get('getCurrentUser', [AuthController::class, 'getCurrentUser']);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('posts', [PostsController::class, 'getAllPosts']); // + tested
Route::get('posts/{id}', [PostsController::class, 'getPostById']);// + tested
Route::get('posts/{id}/comments', [PostsController::class, 'getPostComments']);// + tested
Route::post('posts/{id}/comments', [PostsController::class, 'createNewComment']); // + tested
Route::get('posts/{id}/categories', [PostsController::class, 'getPostCategories']); // + 
Route::get('posts/{id}/likes', [PostsController::class, 'getPostLikes']); // + tested
Route::post('posts', [PostsController::class, 'createNewPost']);// + tested
Route::post('posts/{id}/likes', [PostsController::class, 'setPostLike']); // + tested
Route::patch('posts/{id}', [PostsController::class, 'updatePost']);
Route::delete('posts/{id}', [PostsController::class, 'deletePost']);// + 
Route::delete('posts/{id}/likes', [PostsController::class, 'deletePostLike']); // +


Route::get('categories', [CategoriesController::class, 'getAllCategories']); // +
Route::get('categories/{id}', [CategoriesController::class, 'getCategoryById']); // +
Route::get('categories/{id}/posts', [CategoriesController::class, 'getCategoryPosts']); // +
Route::post('categories', [CategoriesController::class, 'createCategory']); // +
Route::patch('categories/{id}', [CategoriesController::class, 'updateCategory']);
Route::delete('categories/{id}', [CategoriesController::class, 'deleteCategory']); // +


Route::get('comments/{id}', [CommentsController::class, 'getCommentById']);
Route::get('comments/{id}/like', [CommentsController::class, 'getCommentLikes']);
Route::post('comments/{id}/like', [CommentsController::class, 'addLikeToComent']);
Route::patch('comments/{id}', [CommentsController::class, 'updateComment']);
Route::delete('comments/{id}', [CommentsController::class, 'deleteComment']);
Route::delete('comments/{id}/like', [CommentsController::class, 'deleteLikeUnderComment']);





















