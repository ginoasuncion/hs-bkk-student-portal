<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ListPostsController;
use App\Http\Controllers\ManagePostsController;
use App\Http\Controllers\CreatePostController;
use App\Http\Controllers\SinglePostController;
use App\Http\Controllers\CommentListComponentController;
use App\Http\Controllers\EditCommentController;
use App\Http\Controllers\EditPostController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\PhotoController;

Auth::routes();
Route::middleware(['role:admin'])->group(function () { 
    // Route::get('/create-post', [CreatePostController::class, 'create'])->name('create.post');
    Route::get('/create-post', [PostController::class, 'create'])->name('posts.create');
    Route::post('/create-post', [PostController::class, 'store']);

    Route::get('/posts/{postId}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{postId}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/manage-posts', [ManagePostsController::class, 'index'])->name('posts.manager');

    // Route::get('/manage-posts', [ManagePostsController::class, 'index'])->name('manage.posts');
    // Route::delete('/manage-posts/delete-post/{postId}', [ManagePostsController::class, 'deletePost'])->name('manage-posts.delete-post');
    Route::delete('/manage-posts/delete-post/{postId}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/photos/{photoId}', [PhotoController::class, 'destroy'])->name('photos.destroy');
    



    Route::delete('/manage-posts/delete-comment/{commentId}', [ManagePostsController::class, 'deleteComment'])->name('manage-posts.delete-comment');
    // Route::get('/posts/{postId}', [SinglePostController::class, 'show'])->name('single.post');
    Route::get('/posts/{postId}/comments', [CommentListComponentController::class, 'index'])->name('comments.index');
    Route::post('/posts/{postId}/comments', [CommentListComponentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [EditCommentController::class, 'edit'])->name('edit.comment');
    Route::put('/comments/{comment}', [EditCommentController::class, 'update'])->name('comments.update');

    // Route::get('/photos/{photoId}', [EditPostController::class, 'removePhoto'])->name('remove.photo');


});

// Route::get('/posts/{postId}', [SinglePostController::class, 'show'])->name('single.post');
// Route::get('/', [ListPostsController::class, 'index'])->name('landing.page');
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{postId}', [PostController::class, 'show'])->name('posts.show');