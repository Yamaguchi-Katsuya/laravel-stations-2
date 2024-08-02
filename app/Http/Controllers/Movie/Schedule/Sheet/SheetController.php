<?php

namespace App\Http\Controllers\Movie\Schedule\Sheet;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Sheet;

class SheetController extends Controller
{
    public function index($movieId, $scheduleId)
    {
        $date = request('date');
        if (empty($date)) {
            abort(400);
        }

        $sheets = Sheet::query()
            ->leftJoin('reservations', function ($join) use ($scheduleId) {
                $join->on('sheets.id', '=', 'reservations.sheet_id')
                    ->where('reservations.schedule_id', '=', $scheduleId);
            })
            ->select('sheets.*', 'reservations.id as reservation_id')
            ->get();

        $sheets = $sheets->map(function ($sheet) {
            $sheet->is_available = is_null($sheet->reservation_id);
            return $sheet;
        });

        return view('front/movie/schedule/sheet/index', compact('movieId', 'scheduleId', 'date', 'sheets'));
    }
}
