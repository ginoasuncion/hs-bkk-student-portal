<div>
    <h1>All Posts</h1>
    <ul>
        @foreach($posts as $post) 
            <li>{{ $post->title }}</li>
            <li>{{ $post->content }}</li>
        @endforeach
    </ul>
</div>