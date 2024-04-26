<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class CreatePost extends Component
{
    public $title;
    public $content;

    public function rules()
    {
        return [
            'title' => 'required|min:3|unique:posts,title',
            'content' => 'required|min:3',
        ];
    }

    public function savePost()
    {
        $validated = $this->validate();
        Post::create($validated);
        session()->flash('message', 'Post successfully created.');
        return redirect()->to('/create-post');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
