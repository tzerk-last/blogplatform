@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-8">Panel de administración</h1>

    <!-- Métricas -->
    <div class="grid grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-3xl font-bold text-blue-600">{{ $total_blogs }}</p>
            <p class="text-sm text-gray-500 mt-1">Total blogs</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-3xl font-bold text-green-600">{{ $active_blogs }}</p>
            <p class="text-sm text-gray-500 mt-1">Blogs activos</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-3xl font-bold text-purple-600">{{ $total_users }}</p>
            <p class="text-sm text-gray-500 mt-1">Usuarios</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-3xl font-bold text-orange-600">{{ $total_posts }}</p>
            <p class="text-sm text-gray-500 mt-1">Posts totales</p>
        </div>
    </div>

    <!-- Lista de blogs -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold">Blogs registrados</h2>
        </div>
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-6 py-3 text-sm font-medium text-gray-500">Blog</th>
                    <th class="text-left px-6 py-3 text-sm font-medium text-gray-500">Dominio</th>
                    <th class="text-left px-6 py-3 text-sm font-medium text-gray-500">Estado</th>
                    <th class="text-left px-6 py-3 text-sm font-medium text-gray-500">Creado</th>
                    <th class="text-left px-6 py-3 text-sm font-medium text-gray-500">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($recent_blogs as $blog)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">{{ $blog->blog_name ?? 'Sin nombre' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $blog->domains->first()->domain ?? 'Sin dominio' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($blog->is_active)
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Activo</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Suspendido</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-400">
                            {{ $blog->created_at->format('d M, Y') }}
                        </td>
                        <td class="px-6 py-4 flex gap-3">
                            @if($blog->is_active)
                                <form method="POST" action="/admin/tenants/{{ $blog->id }}/suspend">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-yellow-600 hover:underline text-sm">Suspender</button>
                                </form>
                            @endif
                            <form method="POST" action="/admin/tenants/{{ $blog->id }}"
                                onsubmit="return confirm('¿Eliminar este blog permanentemente?')">
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
</div>
@endsection