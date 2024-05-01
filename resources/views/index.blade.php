@extends('layouts.app')

@section("content")
<a href="{{route('post.create')}}" class="btn btn-dark">Create Post </a>
    <h1 style="background-color: white;"> All posts </h1>
    <table class='table'> <tr> <td>ID </td> <td> title</td>
            <td>body</td> <td> Actions </td><td> posted by </td></tr>
        @foreach($posts as $post)
            <tr>
                <td> {{$post->id}}</td>
                <td> {{$post->title}}</td>
                <td> {{$post->body}}</td>
                <td> {{$post->posted_by}}</td>


                <td> <a href="{{route('post.show',$post['id'] )}}" class="btn btn-info">Show  </a></td>
                <td> <a href="{{route('post.edit',$post['id'] )}}" class="btn btn-info">Edit  </a></td>
                <td>
                    <td>
                        <form id="delete-form" action="{{ route('post.destroy', ['id' => $post['id']]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                           
                        </form>
                    </td>
                    
                </td>
                

            </tr>

        @endforeach

    </table>
    {{$posts ->links()}}
@endsection
<script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this post?")) {
            document.getElementById('delete-form').submit();
        }
    }
</script>