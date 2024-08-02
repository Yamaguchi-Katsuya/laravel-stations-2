<?php

namespace App\Http\Controllers\Movie\Schedule\Sheet;

use App\Http\Controllers\Controller;
use App\Models\Sheet;

class SheetController extends Controller
{
    public function index($movieId, $scheduleId)
    {
        $date = request('date');
        if (empty($date)) {
            abort(400);
        }
        // $sheets = Sheet::all();
        $sheets = Sheet::leftJoin('reservations', function ($join) use ($scheduleId, $date) {
            $join->on('sheets.id', '=', 'reservations.sheet_id')
                ->where('reservations.schedule_id', '=', $scheduleId)
                ->whereDate('reservations.date', '=', $date);
        })
            ->select('sheets.*', 'reservations.id as reservation_id')
            ->get();

        // 予約可能かどうかのフラグを追加
        $sheets = $sheets->map(function ($sheet) {
            $sheet->is_available = is_null($sheet->reservation_id);
            return $sheet;
        });
        return view('front/movie/schedule/sheet/index', ['sheets' => $sheets, 'date' => $date, 'movieId' => $movieId, 'scheduleId' => $scheduleId]);
    }
}
