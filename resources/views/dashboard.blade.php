@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Bienvenido al Sistema de Reservas</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <a href="{{ route('rooms.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-2xl shadow text-center transition">
            🛏️ Gestionar Habitaciones
        </a>

        <a href="{{ route('reservations.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-6 rounded-2xl shadow text-center transition">
            ➕ Lista de reservas
        </a>
        <a href="{{ route('reservations.calendar') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-2xl shadow text-center transition">
            📅 Ver Calendario
        </a>



    </div>
</div>
@endsection