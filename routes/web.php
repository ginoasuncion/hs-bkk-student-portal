<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ManagePostsController;

Auth::routes();
Route::middleware(['role:admin'])->group(function () { 

    Route::get('/create-post', [PostController::class, 'create'])->name('posts.create');
    Route::post('/create-post', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{postId}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{postId}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/manage-posts/delete-post/{postId}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/manage-posts/delete-comment/{commentId}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');

    Route::get('/photos/{photoId}', [PhotoController::class, 'destroy'])->name('photos.destroy');
    Route::get('/manage-posts', [ManagePostsController::class, 'index'])->name('posts.manager');
});

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{postId}', [PostController::class, 'show'])->name('posts.show');