@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Nuevo post</h1>
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

        <form method="POST" action="/dashboard/posts" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Imagen de portada</label>
                <input type="file" name="cover_image" accept="image/*"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Categorías</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($categories as $category)
                        <label class="flex items-center gap-1 text-sm">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                <textarea name="body" rows="12"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('body') }}</textarea>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="publish" value="1">
                    Publicar ahora
                </label>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-medium">
                    Guardar post
                </button>
            </div>
        </form>
    </div>
</div>
@endsection