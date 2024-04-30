<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostPhoto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

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

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', Rule::unique('posts', 'title')],
            'content' => 'required|min:5',
            'photos.*' => 'image|max:1024', // 1MB Max for each image
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('post-photos', 'public');

                PostPhoto::create([
                    'post_id' => $post->id,
                    'photo_path' => $photoPath,
                ]);
            }
        }

        return redirect()->route('posts.create')->with('message', 'Post created!');
    }

    public function edit($postId)
    {
        $post = Post::find($postId);
    
        if (!$post) {
            // Handle error or redirect
        }
    
        return view('posts.edit', [
            'postId' => $postId,
            'title' => $post->title,
            'content' => $post->content,
            'existingPhotos' => $post->photos,
            'photos' => [], // Initialize the $photos variable
        ]);
    }

    public function update(Request $request, $postId)
    {
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:5',
            'photos.*' => 'image|max:1024',
        ]);

        $post = Post::find($postId);

        if (!$post) {
            // Handle error or redirect
        }

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('post-photos', 'public');

                PostPhoto::create([
                    'post_id' => $post->id,
                    'photo_path' => $photoPath,
                ]);
            }
        }

        return redirect()->route('posts.show', $postId);
    }

    public function destroy($postId)
    {
        $post = Post::find($postId);
        $post->delete();
        session()->flash('message', 'Post deleted successfully.');
        
        return redirect()->back();
    }
}

