<div wire:poll.10s>
    <h1>All Posts</h1>
    @foreach($posts as $post)
    <div>
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->content }}</p>
        <!-- Display the post image if it exists -->
        @if($post->photo_path)
        <img src="{{ asset('storage/' . $post->photo_path) }}" alt="{{ $post->title }}" width="300">
        @endif
    </div>
    @endforeach
</div>
