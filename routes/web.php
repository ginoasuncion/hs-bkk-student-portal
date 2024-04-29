<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\CreatePost;
use App\Livewire\SinglePost;
use App\Livewire\ManagePosts;
use App\Livewire\EditPost;
use App\Livewire\ListPosts;
use App\Livewire\EditComment;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Auth::routes();
// // Backend routes
// Route::middleware(['auth'])->group(function () { 
//     Route::get('/create-post', CreatePost::class);
//     Route::get('/manage-posts', ManagePosts::class)->name('manage.posts'); 
//     Route::get('/post/{postId}', SinglePost::class)->name('single.post');
//     Route::get('/post/{postId}/edit', EditPost::class)->name('edit.post');
// });


// Backend routes
Route::middleware(['role:admin'])->group(function () { 
    Route::get('/create-post', CreatePost::class)->name('create.post'); 
    Route::get('/manage-posts', ManagePosts::class)->name('manage.posts'); 
    Route::get('/post/{postId}', SinglePost::class)->name('single.post');
    Route::get('/post/{postId}/edit', EditPost::class)->name('edit.post');
   
    Route::get('/comment/{commentId}/edit', EditComment::class)->name('edit.comment');
});

// Frontend Routes
Route::get('/', ListPosts::class)->name('landing.page'); 
Route::get('/post/{postId}', SinglePost::class)->name('single.post');


// Route::get('/edit-post/{postId}', EditPost::class)->name('edit.post');

// Route::get('/', ListPosts::class)->name('landing.page');

// require __DIR__.'/auth.php';

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
