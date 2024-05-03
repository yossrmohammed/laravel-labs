@extends('layouts.app')

@section("content")
<a href="{{ route('post.create') }}" class="btn btn-dark">Create Post</a>
<form action="{{ route('posts.restore') }}" method="POST">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-dark mt-3">Restore Soft Deleted Posts</button>
</form>
<h1 style="background-color: white;">All posts</h1>
<table class='table'>
    <tr>
        <td>ID</td>
        <td>Title</td>
        <td>Body</td>
        <td>Posted By</td>
        <td>Created At</td>
        <td> Slug</td>

        <td>Actions</td>
    </tr>
    @foreach($posts as $post)
    <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->title }}</td>
        <td>{{ $post->body }}</td>
        <td>{{ $post->user->name }}</td>
        <td>{{ $post->created_at->format('Y/m/d H:i') }}</td> 
        <td>{{ $post->title_slug }}</td>
        <td>
            <a href="{{ route('post.show', $post->id) }}" class="btn btn-info">Show</a>
            @can('update', $post)
            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-info">Edit</a>
        @endcan
        @can('delete', $post)
            <form id="delete-form-{{ $post->id }}" action="{{ route('post.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $post->id }}')">Delete</button>
            </form>
        @endcan
        </td>
    </tr>
    @endforeach
</table>
{{ $posts->links() }}
@endsection

<script>
    function confirmDelete(postId) {
        if (confirm("Are you sure you want to delete this post?")) {
            document.getElementById('delete-form-' + postId).submit();
        }
    }
</script>
