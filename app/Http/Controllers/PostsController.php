<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\IdentityController;
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
        $this->middleware('auth:api', ['except' => ['getAllPosts', 'getPostById']]);
    }

    public function getAllPosts() { 
        return response()->json(Posts::all());
    }

    public function getPostById(Request $request, $id)
    {
        return response()->json(Posts::find($id));
    }

    public function createNewPost(Request $request, $id)
    {
        return response()->json(Posts::find($id));
    }
}
