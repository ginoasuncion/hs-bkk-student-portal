<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostPhoto;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class PhotoController extends Controller
{
    public function destroy($photoId)
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
