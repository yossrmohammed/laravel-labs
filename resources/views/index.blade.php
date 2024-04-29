@extends('layouts.app')

@section("content")

    <h1 style="background-color: white;"> All posts </h1>
    <table class='table'> <tr> <td>ID </td> <td> Name</td>
            <td>Salary</td> <td> Actions </td></tr>
        @foreach($posts as $post)
            <tr>
                <td> {{$post['id']}}</td>
                <td> {{$post['title']}}</td>
                <td> {{$post['body']}}</td>

                <td> <a href="{{route('post.show',$post['id'] )}}" class="btn btn-info">Show  </a></td>
                <td> <a href="{{route('post.edit',$post['id'] )}}" class="btn btn-info">Edit  </a></td>
                <td>
                    <td>
                        <a href="{{route('post.delete',$post['id'] )}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                    </td>
                    
                </td>
                

            </tr>

        @endforeach

    </table>
@endsection