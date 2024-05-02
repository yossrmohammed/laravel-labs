@extends("layouts.app")

@section("body")
<div class="card" style="width: 18rem;">
    <img height="300" src="{{ asset('images/posts/'.$post['image']) }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">body:{{ $post->body }}</p>
        <p class="card-text">posted by:{{ $post->posted_by }}</p>
        <p class="card-text">created at:{{ $post->created_at->format('Y/m/d H:i') }}</p>
        <form id="delete-form" action="{{ route('post.destroy', ['id' => $post['id']]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
           
        </form>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    </div>
</div>
<div class="mt-4">
    <h2>Comments</h2>
    @if ($post->comments->count() > 0)
        <ul class="list-group">
            @foreach ($post->comments as $comment)
                <li class="list-group-item">{{ $comment->body }}</li>
            @endforeach
        </ul>
    @else
        <p>No comments available.</p>
    @endif
</div>
<form action="{{ route('comment.store') }}" method="POST">
    @csrf
    
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <textarea name="content" placeholder="Enter your comment"></textarea>
    <button type="submit" class="btn btn-success">Submit Comment</button>
</form>
</div>
</div>
<script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this post?")) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection
