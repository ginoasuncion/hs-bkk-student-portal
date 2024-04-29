<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SinglePostController extends Controller
{
    public function show($postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return view('errors.post-not-found');
        }

        return view('single-post', [
            'post' => $post,
        ]);
    }
}
