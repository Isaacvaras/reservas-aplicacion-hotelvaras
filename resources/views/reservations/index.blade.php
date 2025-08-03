@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📅 Lista de Reservas</h1>
        <a href="{{ route('reservations.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
            ➕ Nueva Reserva
        </a>
    </div>

    @if ($reservations->isEmpty())
        <p class="text-gray-600">No hay reservas registradas.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-xl overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">#</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Cliente</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Habitación</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Ingreso</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Salida</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Noches</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Total (S/)</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-600">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr class="border-t">
                            <td class="py-3 px-4">{{ $reservation->id }}</td>
                            <td class="py-3 px-4">{{ $reservation->guest_name }}</td>
                            <td class="py-3 px-4">{{ $reservation->room->name ?? 'Sin asignar' }}</td>
                            <td class="py-3 px-4">{{ $reservation->check_in }}</td>
                            <td class="py-3 px-4">{{ $reservation->check_out }}</td>
                            <td class="py-3 px-4 text-center">{{ $reservation->nights }}</td>
                            <td class="py-3 px-4">S/ {{ number_format($reservation->total_amount, 2) }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('reservations.edit', $reservation->id) }}"
                                       class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST"
                                          onsubmit="return confirm('¿Estás seguro de eliminar esta reserva?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
