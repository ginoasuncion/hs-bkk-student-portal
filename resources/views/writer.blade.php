<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HS Bangkok Student Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background-color: #3c237f;">
    <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl w-full mx-auto sm:px-6 lg:px-8 space-y-4 py-4">
            <div class="text-center text-white dark:text-gray-300 py-4">
                <h1 class="text-5xl font-bold">Harbour.Space Bangkok Student Portal</h1>
            </div>

            <div class="w-full rounded-md bg-white border-2 border-gray-600 p-4 min-h-[60px] h-full text-gray-600">
                <form action="/writer/generate" method="post" class="inline-flex gap-2 w-full">
                    @csrf
                    <input required name="title" class="w-full outline-none text-2xl font-bold" value="{{ $title }}" placeholder="Put your question here..." />
                    <button class="rounded-md bg-emerald-500 px-4 py-2 text-white font-semibold">Ask</button>
                </form>
            </div>
            @if($content)
            <div class="w-full rounded-md bg-white border-2 border-gray-600 p-4 min-h-[720px] h-full text-gray-600">
                <textarea class="min-h-[500px] h-full w-full outline-none" spellcheck="false">{{ $content }}</textarea>
            </div>
            @endif
        </div>
    </div>
</body>
</html>
