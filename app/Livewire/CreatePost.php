<?php
namespace App\Livewire; use Livewire\Component; use App\Models\Post;

class CreatePost extends Component {

    public $title;
    public $content;
    public function savePost() 
    
    {
        Post::create([
                'title' => $this->title,
                'content' => $this->content
        ]);

        session()->flash('message', 'Post successfully created.');
        return redirect()->to('/create-post'); 

    }

    public function render()
    {
        return view('livewire.create-post');
    }
}