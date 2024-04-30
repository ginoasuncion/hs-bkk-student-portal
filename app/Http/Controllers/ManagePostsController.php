<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class ManagePostsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $posts = Post::where('title', 'like', '%' . $search . '%')
                     ->orWhere('content', 'like', '%' . $search . '%')
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);

        return view('manage-posts', compact('posts', 'search'));
    }
}
