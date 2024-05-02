@extends("layouts.app")

@section("content")
    <h1>Update Post</h1>
    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')


        <div class="form-group">
            <label for="title">Title:</label><br>
            <input type="text" class="form-control" id="title" name="title"
            value="{{ $post->title }}"
            ><br>
            @error("title")
                <div class="alert alert-danger">{{ $message }}</div>
                
            @enderror
            </div>
            <div class="form-group">
                <label for="body">Body:</label><br>
                <input id="body" class="form-control" name="body"
                value="{{  $post->body }}"
                ></input><br>
                @error("body")
                    <div class="alert alert-danger">{{ $message }}</div>
                
                @enderror
                </div>        
        <div class="form-group">
            <label for="user">Select User:</label><br>
            <select class="form-select" id="user" name="posted_by" aria-label="Select User">
                @foreach($users as $user)
                <option value="{{ $user->id }}" @if($user->id === $post->posted_by) selected @endif>{{ $user->name }}</option>
                @endforeach
            </select><br>
            @error("posted_by")
            <div class="alert alert-danger">{{ $message }}</div>
                
            @enderror
            </div>
            <div class="form-group">
                <label for="image">image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
        <button type="submit" class="btn btn-info">Submit</button>
    </form>
@endsection
