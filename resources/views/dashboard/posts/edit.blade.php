@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Editar post</h1>
        <a href="/dashboard" class="text-gray-500 hover:underline">← Volver</a>
    </div>

    <div class="bg-white rounded-lg shadow p-8">
        @if($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/dashboard/posts/{{ $post->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Imagen de portada</label>
                @if($post->cover_image)
                    <img src="{{ asset('storage/' . $post->cover_image) }}"
                        class="w-full h-40 object-cover rounded mb-2">
                @endif
                <input type="file" name="cover_image" accept="image/*"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Categorías</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($categories as $category)
                        <label class="flex items-center gap-1 text-sm">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                {{ $post->categories->contains($category->id) ? 'checked' : '' }}>
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                <textarea name="body" rows="12"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('body', $post->body) }}</textarea>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="publish" value="1"
                        {{ $post->published_at ? 'checked' : '' }}>
                    Publicado
                </label>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-medium">
                    Actualizar post
                </button>
            </div>
        </form>
    </div>
</div>
@endsection