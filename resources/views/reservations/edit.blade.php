@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">✏️ Editar Reserva</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="bg-white shadow-md rounded-xl px-8 pt-6 pb-8">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Nombre del huésped:</label>
            <input type="text" name="guest_name" value="{{ old('guest_name', $reservation->guest_name) }}" required
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Habitación:</label>
            <select name="room_id" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" {{ $reservation->room_id == $room->id ? 'selected' : '' }}>
                        {{ $room->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Fecha de ingreso:</label>
            <input type="date" name="check_in" value="{{ old('check_in', $reservation->check_in->format('Y-m-d')) }}" required
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Fecha de salida:</label>
            <input type="date" name="check_out" value="{{ old('check_out', $reservation->check_out->format('Y-m-d')) }}" required
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Monto total:</label>
            <input type="number" name="total_amount" value="{{ old('total_amount', $reservation->total_amount) }}" step="0.01" required
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('reservations.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Volver</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
