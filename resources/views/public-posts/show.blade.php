@extends('layouts.app')

@section('title', 'View Article')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <!-- Post Title -->
            <h1 class="display-4 mb-5">{{ $post->title }}</h1>

            <!-- Post Images -->
            @foreach($post->photos as $photo)
                <div class="mb-4">
                    <img src="{{ Storage::url($photo->photo_path) }}" alt="{{ $post->title }}" class="img-fluid rounded shadow">
                </div>
            @endforeach

            <!-- Post Content -->
            <div class="post-content text-justify mb-5">
                <p>{{ $post->content }}</p>
            </div>

            <!-- Divider -->
            <hr class="my-5">

            <!-- Comments Section -->
            <h4 class="mt-3">Comments:</h4>
            <br>
            @include('comments.index', ['comments' => $post->comments, 'post' => $post])
        </div>
    </div>
</div>
@endsection
