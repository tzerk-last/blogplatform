<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - {{ $blog->blog_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --color-bg:     {{ $blog->bg_color ?? '#ffffff' }};
            --color-text:   {{ $blog->text_color ?? '#111111' }};
            --color-accent: {{ $blog->accent_color ?? '#3b82f6' }};
            --font-family:  {{ $blog->font ?? 'Inter' }};
        }
        body {
            background-color: var(--color-bg);
            color: var(--color-text);
            font-family: var(--font-family), sans-serif;
        }
        a { color: var(--color-accent); }
    </style>
</head>
<body class="min-h-screen">
    <header class="py-6 border-b">
        <div class="max-w-3xl mx-auto px-4 flex items-center gap-4">
            @if($blog->avatar)
                <img src="{{ asset('storage/' . $blog->avatar) }}"
                    class="w-10 h-10 rounded-full object-cover">
            @endif
            <a href="/" class="font-bold text-xl hover:underline">{{ $blog->blog_name }}</a>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-4 py-10">
        @if($post->cover_image)
            <img src="{{ asset('storage/' . $post->cover_image) }}"
                class="w-full h-64 object-cover rounded-lg mb-8">
        @endif

        <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>

        <p class="text-sm text-gray-400 mb-8">
            {{ $post->published_at->format('d M, Y') }}
        </p>

        @if($post->categories->count())
            <div class="flex gap-2 mb-6">
                @foreach($post->categories as $category)
                    <span class="px-3 py-1 rounded-full text-sm"
                        style="background-color: var(--color-accent); color: white;">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
        @endif

        <div class="prose max-w-none leading-relaxed">
            {!! nl2br(e($post->body)) !!}
        </div>

        <div class="mt-10">
            <a href="/" class="hover:underline">← Volver al blog</a>
        </div>
    </main>
</body>
</html>