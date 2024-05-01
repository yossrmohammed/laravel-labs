@extends("layouts.app")

@section("content")
    <h1>Update Post</h1>
    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="{{ $post->title }}"><br>
        
        <label for="body">Body:</label><br>
        <input type="text" id="body" name="body" value="{{ $post->body }}"><br>
        
        <label for="user">User:</label><br>
        <select name="posted_by" id="user">
            @foreach($users as $user)
                <option value="{{ $user->id }}" @if($user->id === $post->posted_by) selected @endif>{{ $user->name }}</option>
            @endforeach
        </select><br>
        
        <div class="form-group">
            <label for="image">image</label>
            <input type="file" class="form-control-file" id="image" name="image">
          </div>
        <button type="submit" class="btn btn-info">Submit</button>
    </form>
@endsection
