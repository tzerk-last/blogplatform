@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Crear tu blog</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Tu nombre</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
            <input type="password" name="password"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
            <input type="password" name="password_confirmation"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre de tu blog</label>
            <input type="text" name="blog_name" value="{{ old('blog_name') }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Subdominio</label>
            <div class="flex items-center border rounded overflow-hidden">
                <input type="text" name="subdomain" value="{{ old('subdomain') }}"
                    class="flex-1 px-3 py-2 focus:outline-none">
                <span class="bg-gray-100 px-3 py-2 text-gray-500 text-sm">.localhost</span>
            </div>
            <p class="text-xs text-gray-400 mt-1">Solo letras, números y guiones</p>
        </div>
        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-medium">
            Crear mi blog
        </button>
        <p class="text-center text-sm text-gray-500 mt-4">
            ¿Ya tienes cuenta? <a href="/login" class="text-blue-600 hover:underline">Inicia sesión</a>
        </p>
    </form>
</div>
@endsection