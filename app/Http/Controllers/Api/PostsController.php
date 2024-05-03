<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
class PostsController extends Controller
{
    private function file_operations($request){

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filepath=$image->store("images","posts_uploads" );
            return $filepath;

        }
        return null;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::all();
        return response()->json(['posts' => $posts], 200);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|unique:posts',
            'body' => 'required|min:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'posted_by' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $imagePath = $this->file_operations($request);
        
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->image = $imagePath;
        $post->posted_by = $request->posted_by;
        $post->save();
    
        
        return response()->json(['post' => $post], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $post = Post::findOrFail($id);

        // Return the post data as JSON
        return response()->json(['post' => $post], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        $post = Post::findOrFail($id);
        $validator = Validator::make(request()->all(), [
            'title' => Rule::unique('posts')->ignore($post),
            'body' => 'required|min:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'posted_by' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file_path = $this->file_operations(request());
        $request_parms = request()->all();
        if($file_path != null){
             $request_parms['image'] = $file_path;
            }
            //$post->save();
        $post->update($request_parms);
        return response()->json(['message' => 'Post updated successfully'], 200);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
    $post = Post::findOrFail($id);
    $post->delete();

    return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
