<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    function __construct()
    {
        $this->middleware('auth:api', ['except' =>
        ['getAllPosts', 'getPostById', 'getPostComments', 'getPostCategories', 'getPostLikes']]);
    }


    public function getAllCategories(Request $request)
    {
        return response()->json(Categories::all());
    }


    public function getCategoryById(Request $request, $id)
    {
        return response()->json(Categories::find($id));
    }

    public function getCategoryPosts(Request $request, $id)
    {
        return response()->json(Categories::find($id)->posts);
    }

    public function createCategory(Request $request)
    {
        $newCategory = new Category();

        $newCategory->title = $request->input('title');
        $newCategory->description = $request->input('description');

        $newCategory->save();
        
        return response()->json($newCategory->id);
    }

    public function deleteCategory(Request $request, $id)
    {
        Categories::find($id)->delete();
    }
}
