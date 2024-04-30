<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($postId)
    {
        $post = Post::findOrFail($postId);
        $comments = $post->comments()->with('user')->orderBy('created_at', 'desc')->get();

        return view('comments.index', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function create($postId)
    {
        // Find the post by ID
        $post = Post::findOrFail($postId);

        // Redirect to the store method with the post ID
        return redirect()->route('comments.store', $post->id);
    }

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
        return view('comments.edit', compact('comment', 'commentId', 'content'));
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
        return redirect()->route('posts.manager');
    }

    public function destroy($commentId)
    {
        $comment = Comment::find($commentId);

        // Ensure that only the admin or the comment owner can delete the comment
        if (auth()->user()->isAdmin() || auth()->user()->id == $comment->user_id) {
            $comment->delete();
            session()->flash('message', 'Comment deleted successfully.');
        } else {
            session()->flash('error', 'Unauthorized action.');
        }

        return redirect()->back();
    }

}
