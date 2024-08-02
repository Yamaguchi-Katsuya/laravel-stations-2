<?php

namespace App\Http\Controllers\Admin\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdminReservationRequest;
use App\Http\Requests\UpdateAdminReservationRequest;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::query()
            ->with([
                'sheet',
                'schedule',
                'schedule.movie',
            ])
            ->select('reservations.*')
            ->get();
        return view('admin.reservation.index', ['reservations' => $reservations]);
    }

    public function create()
    {
        return view('admin.reservation.create');
    }

    public function store(CreateAdminReservationRequest $request)
    {
        try {
            $validated = $request->validated();

            $sheetId = $validated['sheet_id'];
            $scheduleId = $validated['schedule_id'];
            $reservation = Reservation::query()
                ->where('sheet_id', $sheetId)
                ->where('schedule_id', $scheduleId)
                ->first();
            if ($reservation) {
                abort(400);
            }

            $validated['date'] = now()->toDateString();
            Reservation::create($validated);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route('admin.reservations.index');
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.reservation.edit', ['reservation' => $reservation]);
    }

    public function update($id, UpdateAdminReservationRequest $request)
    {
        try {
            $validated = $request->validated();

            $sheetId = $validated['sheet_id'];
            $scheduleId = $validated['schedule_id'];
            $reservation = Reservation::query()
                ->where('sheet_id', $sheetId)
                ->where('schedule_id', $scheduleId)
                ->first();
            if ($reservation) {
                abort(400);
            }

            Reservation::findOrFail($id)->update($validated);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route('admin.reservations.index');
    }

    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();
        return redirect()->route('admin.reservations.index');
    }
}
