@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Mis posts</h1>
        <div class="flex gap-3">
            <a href="/dashboard/settings"
                class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
                Configuración
            </a>
            <a href="/dashboard/posts/create"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nuevo post
            </a>
        </div>
    </div>

    @if($posts->isEmpty())
        <div class="bg-white rounded-lg shadow p-12 text-center text-gray-400">
            <p class="text-xl mb-4">No tienes posts aún</p>
            <a href="/dashboard/posts/create" class="text-blue-600 hover:underline">
                Crea tu primer post
            </a>
        </div>
    @else
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="text-left px-6 py-3 text-sm font-medium text-gray-500">Título</th>
                        <th class="text-left px-6 py-3 text-sm font-medium text-gray-500">Estado</th>
                        <th class="text-left px-6 py-3 text-sm font-medium text-gray-500">Fecha</th>
                        <th class="text-left px-6 py-3 text-sm font-medium text-gray-500">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">{{ $post->title }}</td>
                            <td class="px-6 py-4">
                                @if($post->published_at)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                        Publicado
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">
                                        Borrador
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">
                                {{ $post->created_at->format('d M, Y') }}
                            </td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="/dashboard/posts/{{ $post->id }}/edit"
                                    class="text-blue-600 hover:underline text-sm">Editar</a>
                                <form method="POST" action="/dashboard/posts/{{ $post->id }}"
                                    onsubmit="return confirm('¿Eliminar este post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:underline text-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $posts->links() }}</div>
    @endif
</div>
@endsection