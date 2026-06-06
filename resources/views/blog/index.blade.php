<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->blog_name }}</title>
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
    <header class="py-12 text-center border-b">
        @if($blog->avatar)
            <img src="{{ asset('storage/' . $blog->avatar) }}"
                class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
        @endif
        <h1 class="text-4xl font-bold">{{ $blog->blog_name }}</h1>
        @if($blog->bio)
            <p class="mt-2 text-gray-500 max-w-xl mx-auto">{{ $blog->bio }}</p>
        @endif
    </header>

    <main class="max-w-3xl mx-auto px-4 py-10">
        @forelse($posts as $post)
            <article class="mb-10 pb-10 border-b">
                @if($post->cover_image)
                    <img src="{{ asset('storage/' . $post->cover_image) }}"
                        class="w-full h-48 object-cover rounded-lg mb-4">
                @endif
                <h2 class="text-2xl font-bold mb-2">
                    <a href="/post/{{ $post->slug }}" class="hover:underline">
                        {{ $post->title }}
                    </a>
                </h2>
                <p class="text-sm text-gray-400 mb-3">
                    {{ $post->published_at->format('d M, Y') }}
                </p>
                <p class="text-gray-600 line-clamp-3">
                    {{ Str::limit(strip_tags($post->body), 200) }}
                </p>
                <a href="/post/{{ $post->slug }}" class="inline-block mt-3 font-medium hover:underline">
                    Leer más →
                </a>
            </article>
        @empty
            <p class="text-center text-gray-400 py-20">No hay publicaciones aún.</p>
        @endforelse

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </main>
</body>
</html>