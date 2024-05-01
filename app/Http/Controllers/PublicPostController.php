<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostPhoto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class PublicPostController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search', '');

        $posts = Post::where('title', 'like', '%' . $search . '%')
                     ->orWhere('content', 'like', '%' . $search . '%')
                     ->orderBy('created_at', 'desc')
                     ->paginate(9);

        return view('public-posts.index', compact('posts', 'search'));
    }

    public function show($postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return view('errors.post-not-found');
        }

        return view('public-posts.show', ['post' => $post]);
    }

}

