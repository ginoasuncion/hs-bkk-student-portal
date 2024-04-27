<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Post;

class ShowPosts extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = Post::all();
    }

    // #[On('post-created')]
    // public function refreshPosts($data)
    // {
    //     $title = $data['title'];

    //     // Re-fetch all posts
    //     $this->posts = Post::all();

    //     // Flash a session message
    //     session()->flash('message', 'A new post was created: ' . $title);
    // }

    public function edit($postId)
    {
        // Fetch the post using the provided ID
        $post = Post::find($postId);

        // Simulate an edit operation
        $post->title .= " - Edited";
        $post->save();

        // Dispatch the post-updated event
        $this->dispatch('post-updated', ['postId' => $post->id]);
    }

    #[On('post-updated')]
    public function refreshSpecificPost($postId)
    {
        // Fetch the post using the provided ID
        $post = Post::where('id', $postId)->first();

        // Flash a session message
        session()->flash('message', 'A post was updated: ' . $post->id);
    }

    public function render()
    {
        return view('livewire.show-posts');
    }
}
