<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\WithPagination;
use Livewire\Component;

class ListPosts extends Component
{
    use WithPagination;
    
    public function render()
    {
        return view('livewire.list-posts', [
            'posts' => Post::orderBy('created_at', 'desc')->paginate(10),
        ])->extends('layouts.app');
    }
}
