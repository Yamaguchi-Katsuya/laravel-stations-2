<?php

namespace App\Http\Controllers\Admin\Movie\Schedule;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateScheduleRequest;
use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Screen;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function create($id)
    {
        Movie::findOrfail($id);
        $screens = Screen::all();

        return view('admin/movie/schedule/create', compact('id', 'screens'));
    }

    public function store(CreateScheduleRequest $request, $id)
    {
        $validated = $request->validated();

        $validated['start_time'] = $validated['start_time_date'] . ' ' . $validated['start_time_time'];
        $validated['end_time'] = $validated['end_time_date'] . ' ' . $validated['end_time_time'];
        $startDateTime = Carbon::parse($validated['start_time']);
        $endDateTime = Carbon::parse($validated['end_time']);
        if ($startDateTime >= $endDateTime || $startDateTime->diffInMinutes($endDateTime) <= 5) {
            return redirect()->back()->withErrors([
                'start_time_time' => '開始時間は終了時間より前である必要があります',
                'end_time_time' => '終了時間は開始時間より後である必要があります',
            ])->withInput($validated);
        }

        $overlappingSchedules = Schedule::where('screen_id', $validated['screen_id'])
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween('start_time', [$startDateTime, $endDateTime])
                    ->orWhereBetween('end_time', [$startDateTime, $endDateTime])
                    ->orWhere(function ($query) use ($startDateTime, $endDateTime) {
                        $query->where('start_time', '<=', $startDateTime)
                            ->where('end_time', '>=', $endDateTime);
                    });
            })
            ->exists();

        if ($overlappingSchedules) {
            return redirect()->back()->withErrors([
                'screen_id' => '選択されたスクリーンはその時間帯に予約済みです',
            ])->withInput($validated);
        }

        Schedule::create($validated);

        return redirect(route('admin.movies.index'));
    }
}
