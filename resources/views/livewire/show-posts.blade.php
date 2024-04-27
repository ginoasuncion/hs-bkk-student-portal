<div wire:poll.10s>
    <input type="text" wire:model="search" placeholder="Search posts...">
    <h1>All Posts</h1>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @foreach($posts as $post)
        <div>
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->content }}</p>
            @foreach($post->photos as $photo)
                <img src="{{ Storage::url($photo->photo_path) }}" alt="{{ $post->title }}" width="300">
            @endforeach
        </div>
        <!-- Display comments for each post -->
        <div class="comments-section">
            <h4>Comments:</h4>
            <livewire:show-comments :postId="$post->id" :key="$post->id"/>
        </div>
    @endforeach
    {{ $posts->links() }}
</div>
