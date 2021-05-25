<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('posts', 'PostsCrudController');
    Route::crud('post_category', 'Post_categoryCrudController');
    Route::crud('likes', 'LikesCrudController');
    Route::crud('comments', 'CommentsCrudController');
    Route::crud('category', 'CategoryCrudController');
}); // this should be the absolute last line of this file