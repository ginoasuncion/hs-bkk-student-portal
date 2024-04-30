<div class="container mt-1">
    @guest
        <div class="alert alert-info">
            <?php session(['url.intended' => url()->current()]); ?>
            Want to join the discussion? <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a>
        </div>
    @endguest

    @foreach($comments as $comment)
        <div class="mb-3">
            <strong>{{ $comment->user->name }}</strong>:
            {{ $comment->content }}
        </div>
    @endforeach

    @auth
        <div class="form-group">
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <textarea name="newComment" class="form-control" rows="3" placeholder="Add a comment...">{{ old('newComment') }}</textarea>
                @error('newComment') <span class="text-danger">{{ $message }}</span> @enderror
                <div class="d-flex justify-content-end" style="margin-top: 5px;"> <!-- Add margin-top to create space -->
                    <button type="submit" class="btn btn-primary" style="background-color: #3c237f; color: white; border-color: #3c237f;">Submit</button>
                </div>
            </form>
        </div>
    @endauth
</div>
