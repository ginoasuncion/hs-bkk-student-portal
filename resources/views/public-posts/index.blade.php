@extends('layouts.app')

@section('title', 'View Resources')
@section('content')
<div class="container mt-5">
    <div class="col-md-10">
        <!-- Description of the Student Portal -->
        <h1>Sawasdee! 🇹🇭 Welcome to HS Bangkok Student Portal!</h1>
        <p>This portal provides access to various resources for students to enhance their learning experience and navigate life in Bangkok. Users can search for content related to academics, city guides, and more.</p>
    </div>

        <div class="row mb-3 justify-content-end">
        <div class="col-md-12">
            <form action="{{ route('public-posts.index') }}" method="GET">
                <div class="input-group search-bar">
                    <input type="text" name="search" class="form-control rounded-pill search-input" placeholder="Search posts...">
                    <div class="input-group-append" style="margin-left: 10px;">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="row">
        @if($posts->count())
            @foreach($posts as $post)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('public-posts.show', $post->id) }}" class="card-link">
                        <div class="card h-100 card-hover">
                            <!-- Display the first image of the post -->
                            @if($post->photos->first())
                                <img src="{{ Storage::url($post->photos->first()->photo_path) }}" alt="{{ $post->title }}" class="card-img-top">
                            @endif
                            <div class="card-body">
                                <h5 style="font-weight: bold;">{{ $post->title }}</h5>
                                <p>{{ Str::limit($post->content, 100) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <p class="text-center">No post found with the given title or content.</p>
            </div>
        @endif
    </div>

    <!-- Pagination links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
