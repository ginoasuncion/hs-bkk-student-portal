<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditPostController extends Controller
{
    public function edit($postId)
    {
        $post = Post::find($postId);
    
        if (!$post) {
            // Handle error or redirect
        }
    
        return view('edit-post', [
            'postId' => $postId,
            'title' => $post->title,
            'content' => $post->content,
            'existingPhotos' => $post->photos,
            'photos' => [], // Initialize the $photos variable
        ]);
    }

    

    public function update(Request $request, $postId)
    {
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'photos.*' => 'image|max:1024',
        ]);

        $post = Post::find($postId);

        if (!$post) {
            // Handle error or redirect
        }

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('post-photos', 'public');
                PostPhoto::create([
                    'post_id' => $postId,
                    'photo_path' => $photoPath,
                ]);
            }
        }

        return redirect()->route('single.post', $postId);
    }

    public function removePhoto($photoId)
    {
        $photo = PostPhoto::find($photoId);

        if ($photo) {
            Storage::disk('public')->delete($photo->photo_path);
            $photo->delete();
        }

        // Handle redirection or response
    }
}
