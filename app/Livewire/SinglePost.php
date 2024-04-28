<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class SinglePost extends Component
{
    public $postId;

    public function mount($postId)
    {
        $this->postId = $postId;
    }

    public function render()
    {
        return view('livewire.single-post', [
            'post' => Post::find($this->postId),
        ])->extends('layouts.app');
    }
}



