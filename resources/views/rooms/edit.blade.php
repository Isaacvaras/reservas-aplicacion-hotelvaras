@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">✏️ Editar Habitación</h1>

    <form action="{{ route('rooms.update', $room->id) }}" method="POST" class="bg-white shadow-md rounded-xl px-8 pt-6 pb-8">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2" for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $room->name) }}"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2" for="description">Descripción:</label>
            <textarea name="description" id="description" rows="4"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $room->description) }}</textarea>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('rooms.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Cancelar</a>
            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection

