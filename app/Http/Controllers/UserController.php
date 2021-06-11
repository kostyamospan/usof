<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\IdentityController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Users;
use Illuminate\Support\Facades\Storage;

class UserController extends IdentityController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllUsers(Request $request) {
        return response()->json(User::all());
    }

    public function getUserById(Request $request, $userId)
    {
        return response()->json(User::find($userId)->toJson());
    }

    public function updateUserData(Request $request)
    {
        
    }
    
    public function deleteUser(Request $request,$userId)
    {
        if($userId != $this->user()->id)  {
            return response('User can delete only itself',501);
        }

        User::find($userId)->delete();
    }


    public function setAvatar(Request $request)
    {
        $newPath = $request->file('avatar')->storeAs('storage\avatars', $this->user()->id . "-" . date("Ymd"));
        $user = $this->user();
        $user->avatarPath = $newPath;
        $user->save();
        return response()->json($newPath);
    }
}
