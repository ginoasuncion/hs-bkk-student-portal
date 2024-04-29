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
            @livewire('comment-component', ['comment' => $comment], key($comment->id))
        </div>
    @endforeach

</div>
