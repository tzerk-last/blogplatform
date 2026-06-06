<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <a href="/" class="font-bold text-xl text-blue-600">BlogPlatform</a>
        <div class="flex gap-4">
            @auth
                <form method="POST" action="/logout">
                    @csrf
                    <button class="text-gray-600 hover:text-red-500">Cerrar sesión</button>
                </form>
            @else
                <a href="/login" class="text-gray-600 hover:text-blue-500">Iniciar sesión</a>
                <a href="/register" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Registrarse</a>
            @endauth
        </div>
    </nav>
    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>