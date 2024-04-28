<div>
    <!-- Button to create a new post -->
    <a href="{{ route('create.post') }}" class="btn btn-primary mb-3">Create New Post</a>

    @foreach($posts as $post)
    <div>
        <h3><a href="{{ route('single.post', $post->id) }}">{{ $post->title }}</a></h3>
        <p>{{ Str::limit($post->content, 100) }}</p>
        <a href="{{ route('edit.post', $post->id) }}">Edit</a>
        <button wire:click="deletePost({{ $post->id }})">Delete</button>
    </div>

    <!-- Display comments for the post -->
    @foreach($post->comments as $comment)
    <div style="margin-left: 20px;">
        <p>{{ $comment->user->name }}: {{ $comment->content }}</p>
        
        <!-- Edit and Delete buttons for the comment -->
        @if(auth()->user()->isAdmin() || auth()->user()->id == $comment->user_id)
        <a href="{{ route('edit.comment', $comment->id) }}">Edit Comment</a>
        <button wire:click="deleteComment({{ $comment->id }})">Delete Comment</button>
        @endif
    </div>
    @endforeach
    @endforeach
    
    {{ $posts->links() }}
</div>
