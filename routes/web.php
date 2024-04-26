<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\CreatePost;
Use App\Livewire\ShowPosts;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/create-post', CreatePost::class);
Route::get('/posts', ShowPosts::class);

require __DIR__.'/auth.php';
