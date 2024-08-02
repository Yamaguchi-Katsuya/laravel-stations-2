<?php

namespace App\Http\Controllers\Admin\Schedule;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view('admin/schedule/index', ['schedules' => $schedules]);
    }

    public function edit($id)
    {
        $schedule = Schedule::find($id);
        return view('admin/schedule/edit', ['schedule' => $schedule]);
    }

    public function update(UpdateScheduleRequest $request, $id)
    {
        $validated = $request->validated();
        $validated['start_time'] = $validated['start_time_date'] . ' ' . $validated['start_time_time'];
        $validated['end_time'] = $validated['end_time_date'] . ' ' . $validated['end_time_time'];
        if ($validated['start_time'] >= $validated['end_time']) {
            return redirect()->back()->withErrors([
                'start_time_time' => 'Start time must be before end time',
                'end_time_time' => 'End time must be after start time',
            ]);
        }
        $schedule = Schedule::find($id);
        $schedule->update($validated);

        return redirect(route('admin.schedules.index'));
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        session()->flash('success', 'Schedule was deleted');

        return redirect(route('admin.schedules.index'));
    }
}
