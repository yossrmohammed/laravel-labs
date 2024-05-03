<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    function __construct(){
        $this->middleware('auth');
    }
    public function show(User $user)
    {
        $posts = $user->posts()->paginate(10);

        return view('profile.show', compact('user', 'posts'));
    }
}
