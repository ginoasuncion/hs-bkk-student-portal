<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class AuthUserCommentController extends Controller
{

    public function store(Request $request)
    {
        // Get the post ID from the request parameters
        $postId = $request->route('postId');
    
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
