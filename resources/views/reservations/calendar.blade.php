@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
        Calendario de Reservas - {{ \Carbon\Carbon::parse($currentMonth)->translatedFormat('F Y') }}
    </h1>

    {{-- Navegación entre meses --}}
    <div class="flex justify-center mb-6 space-x-4">
        <a href="{{ route('reservations.calendar', ['month' => \Carbon\Carbon::parse($currentMonth)->subMonth()->format('Y-m')]) }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">
            &laquo; Mes anterior
        </a>
        <a href="{{ route('reservations.calendar', ['month' => \Carbon\Carbon::parse($currentMonth)->addMonth()->format('Y-m')]) }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">
            Mes siguiente &raquo;
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-sm">
                    <th class="border px-4 py-2 w-40 text-left">Habitación</th>
                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        <th class="border px-2 py-1 text-center w-12">{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr class="text-sm">
                        <td class="border px-4 py-2 font-semibold text-gray-700">{{ $room->name }}</td>
                        @php $day = 1; @endphp
                        @while ($day <= $daysInMonth)
                            @php
                                $currentDate = $startOfMonth->copy()->addDays($day - 1);
                                $reservation = $reservations->first(function ($res) use ($room, $currentDate) {
                                    return $res->room_id === $room->id &&
                                           $res->check_in <= $currentDate &&
                                           $res->check_out > $currentDate;
                                });
                            @endphp

                            @if ($reservation)
                                @php
                                    $start = max($reservation->check_in->copy(), $startOfMonth);
                                    $end = min($reservation->check_out->copy()->subDay(), $startOfMonth->copy()->endOfMonth());
                                    $colspan = $start->diffInDays($end) + 1;
                                @endphp
                                <td colspan="{{ $colspan }}" class="border px-2 py-2 text-center bg-green-200 text-sm font-medium text-gray-900 whitespace-nowrap rounded">
                                    {{ $reservation->guest_name }}
                                </td>
                                @php $day += $colspan; @endphp
                            @else
                                <td class="border px-2 py-2">&nbsp;</td>
                                @php $day++; @endphp
                            @endif
                        @endwhile
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
