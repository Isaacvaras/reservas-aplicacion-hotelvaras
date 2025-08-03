@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Listado de Habitaciones</h1>
        <a href="{{ route('rooms.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-xl shadow transition">
            ➕ Nueva Habitación
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nombre</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Descripción</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($rooms as $room)
                    <tr>
                        <td class="px-6 py-4">{{ $room->name }}</td>
                        <td class="px-6 py-4">{{ $room->description }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('rooms.edit', $room) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-sm">✏️ Editar</a>
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta habitación?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm">🗑️ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay habitaciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

