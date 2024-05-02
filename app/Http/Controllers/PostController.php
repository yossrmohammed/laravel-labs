<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    private function file_operations($request){

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filepath=$image->store("images","posts_uploads" );
            return $filepath;

        }
        return null;
    }

    function index(){
        $posts = Post::paginate(5, $columns=['*'], $pageName='posts');
        $users = User::all();
    return view("index" , ["posts"=>$posts]);
    }
    function show($id){
            $post = Post::findOrFail($id);

            return view('show', ["post"=>$post]);
    }
    function create(){
        $users = User::all();
        return view("create", ['users'=>$users]);
    }
    function store(Request $request){
        $request_params = request()->all();
        $filepath = $this->file_operations($request);
        $request_params['image'] = $filepath;
        $post = Post::create($request_params);
        return to_route('post.show', $post->id);
    }
    function edit($id){
        $post = Post::findOrFail($id);
        $users = User::all();

            return view('edit', ["post"=>$post, "users"=>$users]);
    }
    function update($id){
        $request = request();
        $filepath = $this->file_operations($request);
        $post = Post::findOrFail($id);
        $update_data = request()->all();
        $post->title = $update_data['title']; 
        $post->body = $update_data['body'];
        $post->posted_by = $update_data['posted_by'];
        $post->image = $filepath;

        $post->save();
        return to_route("posts.home");
    }
    function destroy($id){
        $post = Post::findOrFail($id);
        $post->delete();
        
        return to_route('posts.home');
    }
    public function restore()
    {
        $posts = Post::onlyTrashed()->get();
        $posts->restore();
        return to_route('posts.home');
    }
} 
