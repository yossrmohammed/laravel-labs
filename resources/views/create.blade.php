@extends("layouts.app")

@section("content")
    <h1>Create Post</h1>
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
        <label for="title">Title:</label><br>
        <input type="text" class="form-control" id="title" name="title"><br>
        </div>
        <div class="form-group">
        <label for="body">Body:</label><br>
        <input id="body" class="form-control" name="body"></input><br>
        </div>
        <label for="user">Select User:</label><br>
        <select class="form-select" id="user" name="posted_by" aria-label="Select User">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select><br>
        

        <div class="form-group">
            <label for="image">image</label>
            <input type="file" class="form-control-file" id="image" name="image">
          </div>
        <button type="submit">Submit</button>
    </form>
@endsection
