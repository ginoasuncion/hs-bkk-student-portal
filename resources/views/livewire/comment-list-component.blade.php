<div class="container mt-1">
    @if(!auth()->check())
        <div class="alert alert-info">
            <?php session(['url.intended' => url()->current()]); ?>
            Want to join the discussion? <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a>
        </div>
    @endif

    @foreach($comments as $comment)
        <div class="mb-3">
            <strong>{{ $comment->user->name }}</strong>:
            {{ $comment->content }}
        </div>
    @endforeach

    @if(auth()->check())
    <div class="form-group">
        <textarea wire:model="newComment" class="form-control" rows="3" placeholder="Add a comment..."></textarea>
        @error('newComment') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="d-flex justify-content-end" style="margin-top: 5px;"> <!-- Add margin-top to create space -->
        <button wire:click="addComment" class="btn btn-primary" style="background-color: #3c237f; color: white; border-color: #3c237f;">Submit</button>
    </div>
    @endif
</div>

