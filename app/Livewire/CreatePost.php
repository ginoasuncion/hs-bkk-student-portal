<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\Post;

class CreatePost extends Component
{
    #[Rule('required', message: 'Please enter a title.')]
    #[Rule('min:5', message: 'Your title is too short.')]
    public $title = '';

    #[Rule('required', message: 'Please enter content.')]
    #[Rule('min:5', message: 'Your content is too short.')]
    public $content = '';

    public function save()
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        return redirect()->to('/posts');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
