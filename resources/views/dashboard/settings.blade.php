@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Configuración del blog</h1>
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

        <form method="POST" action="/dashboard/settings" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del blog</label>
                <input type="text" name="blog_name" value="{{ old('blog_name', $blog->blog_name) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Biografía</label>
                <textarea name="bio" rows="3"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('bio', $blog->bio) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Avatar</label>
                @if($blog->avatar)
                    <img src="{{ asset('storage/' . $blog->avatar) }}"
                        class="w-20 h-20 rounded-full object-cover mb-2">
                @endif
                <input type="file" name="avatar" accept="image/*"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Color de fondo</label>
                    <input type="color" name="bg_color" value="{{ old('bg_color', $blog->bg_color) }}"
                        class="w-full h-10 border rounded cursor-pointer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Color de texto</label>
                    <input type="color" name="text_color" value="{{ old('text_color', $blog->text_color) }}"
                        class="w-full h-10 border rounded cursor-pointer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Color de acento</label>
                    <input type="color" name="accent_color" value="{{ old('accent_color', $blog->accent_color) }}"
                        class="w-full h-10 border rounded cursor-pointer">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipografía</label>
                <select name="font"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Inter" {{ $blog->font == 'Inter' ? 'selected' : '' }}>Inter</option>
                    <option value="Georgia" {{ $blog->font == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                    <option value="monospace" {{ $blog->font == 'monospace' ? 'selected' : '' }}>Monospace</option>
                </select>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-medium">
                Guardar configuración
            </button>
        </form>
    </div>
</div>
@endsection