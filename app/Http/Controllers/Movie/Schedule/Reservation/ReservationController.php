<?php

namespace App\Http\Controllers\Movie\Schedule\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReservationRequest;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function create($movieId, $scheduleId)
    {
        $sheetId = request('sheetId');
        $date = request('date');
        if (empty($sheetId) || empty($date)) {
            abort(400);
        }

        $reservation = Reservation::query()
            ->where('sheet_id', $sheetId)
            ->where('schedule_id', $scheduleId)
            ->first();
        if ($reservation) {
            abort(400);
        }

        return view('front/movie/schedule/reservation/create', [
            'movieId' => $movieId,
            'scheduleId' => $scheduleId,
            'sheetId' => $sheetId,
            'date' => $date
        ]);
    }

    public function store(CreateReservationRequest $request)
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

            Reservation::create($validated);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route('movies.index');
    }
}
