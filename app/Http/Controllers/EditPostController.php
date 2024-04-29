<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


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
            'content' => 'required|min:5',
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
                // Resize the image to a width of 800 and constrain aspect ratio (auto height)
                // $resizedImage = Image::make($photo->getRealPath())->resize(100, null, function ($constraint) {
                //     $constraint->aspectRatio();
                // });
                $photoPath = $photo->store('post-photos', 'public');

                // Save the resized image to the same path as the original
                // $resizedImage->save(public_path('storage/' . $photoPath));

                PostPhoto::create([
                    'post_id' => $post->id,
                    'photo_path' => $photoPath,
                ]);
            }
        }

        return redirect()->route('single.post', $postId);
    }

    public function removePhoto($photoId)
    {
        $photo = PostPhoto::find($photoId); // Find the photo by ID

        if ($photo) {
            Storage::disk('public')->delete($photo->photo_path); // Delete the photo file
            $photo->delete(); // Delete the photo record
        }

        // Handle redirection or response
        return back();
    }
}
