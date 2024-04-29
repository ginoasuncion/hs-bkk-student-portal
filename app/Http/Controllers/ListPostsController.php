<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListPostsController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search', '');

        $posts = Post::where('title', 'like', '%' . $search . '%')
                     ->orWhere('content', 'like', '%' . $search . '%')
                     ->orderBy('created_at', 'desc')
                     ->paginate(9);

        return view('list-posts', compact('posts', 'search'));
    }
}

