<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;

class CreatePost extends Component
{
    use WithFileUploads;

    public $title;
    public $content;
    public $photos = []; // Changed from $photo to $photos and initialized as an array

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'photos.*' => 'image|max:1024',
        ]);

        $post = Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        foreach ($this->photos as $photo) {
            $photoPath = $photo->store('post-photos', 'public');
            $post->photos()->create(['photo_path' => $photoPath]);
        }

        // Reset fields
        $this->title = '';
        $this->content = '';
        $this->photos = [];

        session()->flash('message', 'Post created!');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
