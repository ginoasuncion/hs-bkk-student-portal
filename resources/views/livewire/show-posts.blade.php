<div>
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
            <button wire:click="edit({{ $post->id }})">Edit</button>
            <livewire:show-comments :postId="$post->id" :key="$post->id"/>
        </div>
    @endforeach
</div>
