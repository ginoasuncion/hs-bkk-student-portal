<?php

namespace App\Http\Controllers;
use OpenAI\Laravel\Facades\OpenAI;

use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->title == null) {
            return;
        }
    
        $title = $request->title;
    
        $result = OpenAI::completions()->create([
            "model" => "gpt-3.5-turbo-instruct",
            "temperature" => 0.7,
            "top_p" => 1,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
            'max_tokens' => 600,
            'prompt' => sprintf('Write article about: %s', $title),
        ]);
    
        $content = trim($result['choices'][0]['text']);
    
    
        return view('writer', compact('title', 'content'));
    }    
}
