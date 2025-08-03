@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">➕ Crear Nueva Reserva</h1>

    <form action="{{ route('reservations.store') }}" method="POST" class="bg-white shadow-md rounded-xl px-8 pt-6 pb-8">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2" for="person_name">Nombre del cliente:</label>
            <input type="text" name="person_name" id="person_name" value="{{ old('person_name') }}"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2" for="room_id">Habitación:</label>
            <select name="room_id" id="room_id"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">Seleccione una habitación</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2" for="check_in_date">Fecha de ingreso:</label>
            <input type="date" name="check_in_date" id="check_in_date" value="{{ old('check_in_date') }}"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2" for="check_out_date">Fecha de salida:</label>
            <input type="date" name="check_out_date" id="check_out_date" value="{{ old('check_out_date') }}"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2" for="nights">Noches de estadía:</label>
            <input type="number" name="nights" id="nights" value="{{ old('nights') }}"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2" for="total_amount">Monto a pagar (S/):</label>
            <input type="number" step="0.01" name="total_amount" id="total_amount" value="{{ old('total_amount') }}"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('reservations.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Volver</a>
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection
