@extends("layouts.app")

@section("content")
    <h1>update Post</h1>
    <form action="/submit_post" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value='@php
            echo $post['title']
        @endphp'><br>
        
        <label for="body">Body:</label><br>
        <input type="text" id="body" name="body"
        value='@php
            echo $post['body']
        @endphp'
        ></input><br>
        
        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br>
        
        <button type="submit" class="btn btn-info">Submit</button>
    </form>
</body>
@endsection