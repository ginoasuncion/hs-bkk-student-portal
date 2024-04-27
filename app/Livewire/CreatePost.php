<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\Post;

class CreatePost extends Component
{
    #[Rule('required')]
    #[Rule('min:5')]
    public $title;

    #[Rule('required')]
    #[Rule('min:10')]
    public $content;

    public function savePost()
    {
        $this->validate();

        $post = Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        // Dispatch the event
        $this->dispatch('post-created', title: $post->title);

        // Update component state or flash message
        session()->flash('message', 'Post created!');
    }
}
