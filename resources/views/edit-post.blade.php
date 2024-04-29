@extends('layouts.app')
@section('title', 'Edit Article')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10"> <!-- Increased col-md from 8 to 10 for wider card -->
            <div class="card">
                <div class="card-header" style="background-color: #3c237f; color: white;"> <!-- Changed background color and text color -->
                    <h2 class="card-title mb-0">Edit Post</h2>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    <form action="{{ route('update.post', $postId) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" value="{{ old('title', $title) }}" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title">
                            @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" rows="5" placeholder="Content">{{ old('content', $content) }}</textarea>
                            @error('content') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            @foreach($existingPhotos as $photo)
                                <img src="{{ Storage::url($photo->photo_path) }}" alt="{{ $title }}" width="100" class="mr-2">
                                <a href="{{ route('remove.photo', $photo->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="photos" class="form-label">Upload New Photos:</label>
                            <input type="file" name="photos[]" multiple class="form-control-file @error('photos.*') is-invalid @enderror" id="photos">
                            @error('photos.*') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            @if ($photos)
                                @foreach($photos as $photo)
                                    <img src="{{ $photo->temporaryUrl() }}" width="100" class="mr-2">
                                @endforeach
                            @endif
                        </div>
                        <button type="submit" class="btn" style="background-color: #3c237f; color: white;">Update Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection