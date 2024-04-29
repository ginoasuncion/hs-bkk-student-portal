<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostPhoto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class CreatePostController extends Controller
{
    public function create()
    {
        return view('create-post');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', Rule::unique('posts', 'title')],
            'content' => 'required|min:3',
            'photos.*' => 'image|max:1024', // 1MB Max for each image
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
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
        }

        return redirect()->route('create.post')->with('message', 'Post created!');
    }
}
