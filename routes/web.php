<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WriterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/writer', function () {
    $title = '';
    $content = '';
    return view('writer', compact('title', 'content'));
});

Route::post('/writer/generate', [WriterController::class, 'index']);