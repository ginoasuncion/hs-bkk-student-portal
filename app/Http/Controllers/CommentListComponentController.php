<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentListComponentController extends Controller
{
    public function index($postId)
    {
        $post = Post::findOrFail($postId);
        $comments = $post->comments()->with('user')->orderBy('created_at', 'desc')->get();

        return view('comment-list-component', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function store(Request $request, $postId)
    {
        // Validate the request
        $request->validate([
            'newComment' => 'required|min:5',
        ]);

        // Create the comment
        Comment::create([
            'post_id' => $postId,
            'user_id' => auth()->id(),
            'content' => $request->input('newComment'),
        ]);

        // Redirect back to the post
        return redirect()->back()->with('success', 'Comment added successfully!');
    }

}
