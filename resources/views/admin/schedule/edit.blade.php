<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schedule 編集</title>
</head>
<body>
    <form action="{{ route('admin.schedules.update', ['id' => $schedule->id]) }}" method="post">
        @method('PATCH')
        @csrf
        <input type="hidden" name="movie_id" value="{{ $schedule->movie_id }}">
        {{-- 開始日付 --}}
        <div>
            <label for="start_time">開始日付</label>
            <input type="datetime" name="start_time_date" id="start_time_date" value="{{ $schedule->start_time->format('Y-m-d') }}">
        </div>
        <div>
            <label for="start_time">開始時刻</label>
            <input type="time" name="start_time_time" id="start_time_time" value="{{ $schedule->start_time->format('H:i') }}">
        </div>
        {{-- 終了日付 --}}
        <div>
            <label for="end_time">終了日付</label>
            <input type="datetime" name="end_time_date" id="end_time_date" value="{{ $schedule->end_time->format('Y-m-d') }}">
        </div>
        <div>
            <label for="end_time">終了時刻</label>
            <input type="time" name="end_time_time" id="end_time_time" value="{{ $schedule->end_time->format('H:i') }}">
        </div>
        <button type="submit">更新</button>
    </form>
</body>
</html>
