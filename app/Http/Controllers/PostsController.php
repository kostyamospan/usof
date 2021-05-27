<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\IdentityController;
use App\Models\Comments;
use App\Models\Likes;
use App\Models\Post_category;
use App\Models\Posts;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class PostsController extends IdentityController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>
        ['getAllPosts', 'getPostById', 'getPostComments', 'getPostCategories', 'getPostLikes']]);
    }

    public function getAllPosts()
    {
        return response()->json(Posts::all());
    }

    public function getPostById(Request $request, $id)
    {
        return response()->json(Posts::find($id));
    }

    public function getPostComments(Request $request, $id)
    {
        return response()->json(Posts::find($id)->comments);
    }

    public function getPostCategories(Request $request, $id)
    {
        return response()->json(Posts::find($id)->categories);
    }

    public function createNewPost(Request $request)
    {
        $user = auth()->user();

        $newPost = new Posts();

        $newPost->user_id = $user->id;
        $newPost->publishDate = date('Y-m-d H:i:s');
        $newPost->status = 'active';

        $newPost->title = $request->input("title");
        $newPost->content = $request->input("content");

        $newPost->save();

        if ($categories = json_decode($request->input("categories"))) {
            foreach ($categories as $category) {
                $newPostCategiry = new Post_category();

                $newPostCategiry->post_id = $newPost->id;
                $newPostCategiry->category_id = $category;
            }
        }

        return response()->json($newPost->post_id);
    }

    public function createNewComment(Request $request, $id)
    {
        $newComment = new Comments();
        $newComment->user_id = auth()->user()->id;
        $newComment->post_id = $id;

        $newComment->publishDate = date('Y-m-d H:i:s');
        $newComment->content = $request->input("content");

        $newComment->save();

        return response()->json($newComment->post_id);
    }

    public function getPostLikes(Request $request, $id)
    {
        return response()->json(Posts::find($id)->likes);
    }

    public function setPostLike(Request $request, $id)
    {
        $newLike = new Likes();

        $newLike->type = $request->input('type');
        $newLike->user_id = auth()->user()->id;
        $newLike->post_id = $id;

        $newLike->save();
    }

    public function deletePost(Request $request, $id)
    {
        Posts::find($id)->delete();
    }

    public function deletePostLike(Request $request, $id)
    {
        Posts::where('user_id', auth()->user()->id, 'post_id', $id)->delete();
    }
}
