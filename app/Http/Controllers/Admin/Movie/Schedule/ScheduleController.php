<?php

namespace App\Http\Controllers\Admin\Movie\Schedule;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateScheduleRequest;
use App\Models\Movie;
use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function create($id)
    {
        $movie = Movie::findOrfail($id);
        return view('admin/movie/schedule/create', ['id' => $id]);
    }

    public function store(CreateScheduleRequest $request, $id)
    {
        $movie = Movie::findOrfail($id);
        $validated = $request->validated();
        $validated['start_time'] = $validated['start_time_date'] . ' ' . $validated['start_time_time'];
        $validated['end_time'] = $validated['end_time_date'] . ' ' . $validated['end_time_time'];
        $startDateTime = Carbon::parse($validated['start_time']);
        $endDateTime = Carbon::parse($validated['end_time']);
        if ($startDateTime >= $endDateTime || $startDateTime->diffInMinutes($endDateTime) <= 5) {
            return redirect()->back()->withErrors([
                'start_time_time' => 'Start time must be before end time',
                'end_time_time' => 'End time must be after start time',
            ]);
        }
        $validated['movie_id'] = $movie->id;
        Schedule::create($validated);

        return redirect(route('admin.movies.index'));
    }
}
