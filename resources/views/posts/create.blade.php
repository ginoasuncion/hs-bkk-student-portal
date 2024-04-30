@extends('layouts.app')

@section('title', 'Create Article')

@section('content')
<div class="container mt-5">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('posts.create') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="4">{{ old('content') }}</textarea>
            @error('content')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="photos" class="form-label">Upload Photos</label>
            <input type="file" class="form-control" id="photos" name="photos[]" multiple>
            @error('photos.*')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Image Preview for CreatePost -->
        @if (old('photos'))
            <div class="mb-3">
                @foreach(old('photos') as $photo)
                    <img src="{{ URL::temporarySignedRoute('image.preview', now()->addMinutes(5), ['path' => $photo->getRealPath()]) }}" class="img-thumbnail" width="100">
                @endforeach
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>
@endsection
