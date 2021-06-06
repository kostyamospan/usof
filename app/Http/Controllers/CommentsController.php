<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Likes;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:api', ['except' =>
        ['getAllPosts', 'getPostById', 'getPostComments', 'getPostCategories', 'getPostLikes']]);
    }


    public function getCommentById(Request $request, $id)
    {
        return response()->json(Comments::find($id));
    }

    public function getCommentLikes(Request $request, $id)
    {
        return response()->json(Comments::find($id)->likes);
    }

    public function addLikeToComent(Request $request, $id)
    {
        $comment = Comments::find($id);

        $newLike = new Likes();
        $newLike->user_id = auth()->user()->id;
        $newLike->post_id = $comment->post_id;
        


        return response()->json();
    }
}
