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

    public function deletePost($postId)
    {
        $post = Post::find($postId);
        $post->delete();
        session()->flash('message', 'Post deleted successfully.');
        
        return redirect()->back();
    }

    public function deleteComment($commentId)
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
