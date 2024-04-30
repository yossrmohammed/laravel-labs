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
                        <form method="post" action="{{route('post.destroy', $post->id)}}">
                            @method('delete')
                            @csrf
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                    
                </td>
                

            </tr>

        @endforeach

    </table>
    {{$posts ->links()}}
@endsection