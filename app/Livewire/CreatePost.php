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
    public $photo;

    public function savePost()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'photo' => 'image|max:1024', // 1MB Max
        ]);

        // Store the file in the storage/app/public/post-photos directory
        $photoPath = $this->photo->store('post-photos', 'public');

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'photo_path' => $photoPath,
        ]);

        // Reset fields
        $this->title = '';
        $this->content = '';
        $this->photo = '';

        // Update component state or flash message
        session()->flash('message', 'Post created!');
    }
}
