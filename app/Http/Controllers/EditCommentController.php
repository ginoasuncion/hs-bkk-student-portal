<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class EditCommentController extends Controller
{
    public function edit($commentId)
    {
        // Find the comment by ID
        $comment = Comment::find($commentId);
    
        // If comment does not exist, return an error or redirect to appropriate page
        if (!$comment) {
            // Handle error or redirect
        }
    
        // Get the content of the comment
        $content = $comment->content;
    
        // Return the view for editing the comment, passing the comment ID and content to the view
        return view('edit-comment', compact('comment', 'commentId', 'content'));
    }

    public function update(Request $request, $commentId)
    {
        // Validate the request data
        $request->validate([
            'content' => 'required|min:5',
        ]);

        // Find the comment by ID
        $comment = Comment::find($commentId);

        // If comment does not exist, return an error or redirect to appropriate page
        if (!$comment) {
            // Handle error or redirect
        }

        // Update the content of the comment
        $comment->content = $request->input('content');
        $comment->save();

        // Flash a session message to inform the user of the successful update.
        session()->flash('message', 'Comment updated successfully.');

        // Redirect the user to a different route (e.g., manage posts page).
        return redirect()->route('manage.posts');
    }
}
