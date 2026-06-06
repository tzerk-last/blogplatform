@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Iniciar sesión</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
            <input type="password" name="password"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-medium">
            Iniciar sesión
        </button>
        <p class="text-center text-sm text-gray-500 mt-4">
            ¿No tienes cuenta? <a href="/register" class="text-blue-600 hover:underline">Regístrate</a>
        </p>
    </form>
</div>
@endsection