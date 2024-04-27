<div>
    <input type="text" wire:model.live="search" placeholder="Search posts...">
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
            <!-- Display the post image if it exists -->
            <!-- @if($post->photo_path) -->
            <!-- <img src="{{ asset('storage/' . $post->photo_path) }}" alt="{{ $post->title }}" width="300">  -->
            <!-- @endif   -->
            @foreach($post->photos as $photo)
                <img src="{{ Storage::url($photo->photo_path) }}" alt="{{ $post->title }}" width="300">
            @endforeach
            <button wire:click="edit({{ $post->id }})">Edit</button>
        </div>
    @endforeach

    {{ $posts->links() }}
</div>
