<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('room')->get(); // trae también los datos de la habitación
        return view('reservations.index', compact('reservations'));
    }


    public function create()
    {
        $rooms = Room::all();
        return view('reservations.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'person_name' => 'required|string|max:255',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $checkIn = new \DateTime($validated['check_in_date']);
        $checkOut = new \DateTime($validated['check_out_date']);
        $nights = $checkIn->diff($checkOut)->days;

        Reservation::create([
            'guest_name' => $validated['person_name'], // ← cambia aquí
            'room_id' => $validated['room_id'],
            'check_in' => $validated['check_in_date'], // ← cambia aquí
            'check_out' => $validated['check_out_date'], // ← cambia aquí
            'nights' => $nights,
            'total_amount' => $validated['total_amount'],
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reserva creada correctamente.');
    }


    public function edit(Reservation $reservation)
    {
        $rooms = Room::all();
        return view('reservations.edit', compact('reservation', 'rooms'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $checkIn = new \DateTime($request->check_in);
        $checkOut = new \DateTime($request->check_out);
        $nights = $checkIn->diff($checkOut)->days;

        $reservation->update([
            'guest_name' => $request->guest_name,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'nights' => $nights,
            'total_amount' => $request->total_amount,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reserva actualizada.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reserva eliminada.');
    }

// ReservationController.php


public function calendar(Request $request)
{
    $currentMonth = $request->input('month', now()->format('Y-m'));
    $startOfMonth = \Carbon\Carbon::createFromFormat('Y-m', $currentMonth)->startOfMonth();
    $endOfMonth = $startOfMonth->copy()->endOfMonth();
    $daysInMonth = $startOfMonth->daysInMonth;

    $rooms = Room::orderBy('name')->get(); // opcional para orden

    // ✅ Obtener TODAS las reservas que se cruzan con el mes actual
    $reservations = Reservation::whereDate('check_in', '<=', $endOfMonth)
        ->whereDate('check_out', '>=', $startOfMonth)
        ->get();

    return view('reservations.calendar', compact('rooms', 'reservations', 'daysInMonth', 'currentMonth', 'startOfMonth'));
}





    public function show($id)
    {
        // Puedes redireccionar por ahora
        return redirect()->route('reservations.index');
    }
}
