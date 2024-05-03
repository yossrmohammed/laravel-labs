
@extends('layouts.app')

@section('content')
    <div>
        <h1>{{ $user->name }}'s Profile</h1>
        <p>Email: {{ $user->email }}</p>
        <p>Posts:</p>
        @if ($posts->isEmpty())
            <p>No posts found.</p>
        @else
            <ul>
                @foreach ($posts as $post)
                    <li>{{ $post->title }}</li>
                @endforeach
            </ul>
            {{ $posts->links() }}
        @endif
    </div>
@endsection
