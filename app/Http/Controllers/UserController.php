<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::paginate(15);
        //dd($user);
        return \App\Http\Resources\User::collection($user);
    }
    
    public function delete($id)
    {
        //dd($id);
        $user = User::where('id', $id)->first();
    
        if ($user->delete()){
            return new \App\Http\Resources\User($user);
        }
    }
    
    public function show(Request $request, User $user)
    {
        $newuser = User::where('id', $user->id)->first();
        return new \App\Http\Resources\User($newuser);
    }
}
