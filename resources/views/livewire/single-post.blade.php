<div>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    @foreach($post->photos as $photo)
        <img src="{{ Storage::url($photo->photo_path) }}" alt="{{ $post->title }}" width="300">
    @endforeach
</div>
