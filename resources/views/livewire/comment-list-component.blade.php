<div class="container mt-5">
    @if(!auth()->check())
        <div class="alert alert-info">
            <?php session(['url.intended' => url()->current()]); ?>
            Want to join the discussion? <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a>
        </div>
    @endif

    @foreach($comments as $comment)
        <div class="mb-3">
            {{ $comment->content }}
            <strong>{{ $comment->user->name }}</strong>:
            @livewire('comment-component', ['comment' => $comment], key($comment->id))
        </div>
    @endforeach

    @if(auth()->check())
        <div class="form-group">
            <textarea wire:model="newComment" class="form-control" rows="3" placeholder="Add a comment..."></textarea>
            @error('newComment') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button wire:click="addComment" class="btn btn-primary">Submit</button>
    @else
        <p>Please <a href="{{ route('login') }}">login</a> to comment.</p>
    @endif
</div>
