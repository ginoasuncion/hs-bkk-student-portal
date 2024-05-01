<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthUserCommentController;
use App\Http\Controllers\PublicPostController;

// Public routes
Route::get('/', [PublicPostController::class, 'index'])->name('public-posts.index');
Route::get('/posts/{postId}', [PublicPostController::class, 'show'])->name('public-posts.show');

Auth::routes();

// Authenticated User (User and Admin) routes
Route::middleware('auth')->group(function () { 
    Route::post('/posts/{postId}/comments', [AuthUserCommentController::class, 'store'])->name('comments.store');
});

// Admin routes
Route::middleware(['role:admin'])->group(function () { 
    Route::resource('admin/posts', PostController::class)->except(['show']);
    Route::resource('admin/comments', CommentController::class)->only(['edit', 'update', 'destroy']);
    Route::get('admin/photos/{photoId}', [PhotoController::class, 'destroy'])->name('photos.destroy');
});
