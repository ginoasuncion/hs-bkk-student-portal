<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\PostPhoto;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule as ValidationRule;
use Intervention\Image\Facades\Image;

class CreatePost extends Component
{
    use WithFileUploads;

    public $title = '';
    public $content = '';
    public $photos = [];

    // For properties that need more complex validation rules,
    // you can define them in the rules() method.
    public function rules()
    {
        return [
            'title' => ValidationRule::unique('posts', 'title'),
            'content' => 'required|min:3',
            'photos.*' => 'image|max:1024', // 1MB Max for each image
        ];
    }

    public function save()
    {
        $this->validate(); // This will validate using both the #[Rule] attributes and the rules() method.
        $post = Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        foreach ($this->photos as $photo) {
            // Resize the image to a width of 800 and constrain aspect ratio (auto height)
            $resizedImage = Image::make($photo->getRealPath())->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $photoPath = $photo->store('post-photos', 'public');

            // Save the resized image to the same path as the original
            $resizedImage->save(public_path('storage/' . $photoPath));

            PostPhoto::create([
                'post_id' => $post->id,
                'photo_path' => $photoPath,
            ]);
        }

        $this->reset(['title', 'content', 'photos']);

        return redirect()->to('/create-post')->with('message', 'Post created!');
    }

    public function render()
    {
        return view('livewire.create-post')->extends('layouts.app');
    }
}
