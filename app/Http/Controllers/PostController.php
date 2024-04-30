<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search', '');

        $posts = Post::where('title', 'like', '%' . $search . '%')
                     ->orWhere('content', 'like', '%' . $search . '%')
                     ->orderBy('created_at', 'desc')
                     ->paginate(9);

        return view('posts.index', compact('posts', 'search'));
    }

    public function show($postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return view('errors.post-not-found');
        }

        return view('posts.show', ['post' => $post]);
    }
}

