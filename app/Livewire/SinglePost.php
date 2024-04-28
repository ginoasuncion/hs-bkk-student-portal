<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class SinglePost extends Component
{
    public $postId;
    protected $listeners = ['commentAdded' => 'refreshComments'];

    public function mount($postId)
    {
        $this->postId = $postId;
    }

    public function render()
    {
        $post = Post::find($this->postId);

        if (!$post) {
            return view('errors.post-not-found')->extends('layouts.app');
        }

        return view('livewire.single-post', [
            'post' => $post,
        ])->extends('layouts.app');
    }
}



