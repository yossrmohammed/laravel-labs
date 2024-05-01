@extends("layouts.app")

@section("body")
<div class="card" style="width: 18rem;">
    <img height="300" src="{{ asset('images/posts/'.$post['image']) }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">{{ $post['title'] }}</h5>
        <p class="card-text">body:{{ $post['body'] }}</p>
        <p class="card-text">posted by:{{ $post['posted_by'] }}</p>

        <form id="delete-form" action="{{ route('post.destroy', ['id' => $post['id']]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
           
        </form>
        <a href="{{ route("posts.home") }}" class="btn btn-primary">Back</a>
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
