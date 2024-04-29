@extends("layouts.app")

@section("content")
    <h1>Create Post</h1>
    <form action="/submit_post" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br>
        
        <label for="body">Body:</label><br>
        <textarea id="body" name="body"></textarea><br>
        
        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br>
        
        <button type="submit">Submit</button>
    </form>
</body>
@endsection