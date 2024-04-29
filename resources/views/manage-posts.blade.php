@extends('layouts.app')

@section('title', 'Manage Resources')

@section('content')
<div class="container mt-5">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row mb-3">
        <div class="col-md-12">
            <form action="{{ route('manage.posts') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search posts...">
                    <!-- Add some horizontal space -->
                    <div class="input-group-append" style="margin-left: 10px;">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Button to create a new post -->
    <a href="{{ route('create.post') }}" class="btn btn-primary mb-3">Create New Post</a>

    @if($posts->count())
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">
                        <a href="{{ route('single.post', $post->id) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                    <a href="{{ route('edit.post', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('manage-posts.delete-post', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                    </form>
                    <h4 class="mt-3">Comments: {{ $post->comments->count() }}</h4>
                    @foreach($post->comments as $comment)
                        <div class="ml-4 mb-2">
                            <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
                            <!-- Edit and Delete buttons for the comment -->
                            @if(auth()->user()->isAdmin() || auth()->user()->id == $comment->user_id)
                                <a href="{{ route('edit.comment', $comment->id) }}" class="btn btn-warning btn-sm">Edit Comment</a>
                                <form action="{{ route('manage-posts.delete-comment', $comment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this comment?')">Delete Comment</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center">No post found with the given title or content.</p>
    @endif
    <div class="d-flex justify-content-center">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
