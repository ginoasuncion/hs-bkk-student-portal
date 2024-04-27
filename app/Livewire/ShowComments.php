<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class ShowComments extends Component
{
    use WithPagination;

    // #[Reactive]
    public $postId;
    public $newComment;
    public $author;

    public function addComment()
    {
        Comment::create([
            'post_id' => $this->postId,
            'author' => $this->author,
            'content' => $this->newComment,
        ]);

        $this->newComment = '';
        $this->author = '';
    }

    public function render()
    {
        $comments = Comment::where('post_id', $this->postId)
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('livewire.show-comments', ['comments' => $comments]);
    }
}
