<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール登録</title>
</head>
<body>
    <form action="{{ route('admin.movies.schedules.store', ['id' => $id]) }}" method="POST">
        @csrf
        <input type="hidden" name="movie_id" value="{{ $id }}">
        {{-- 開始日時 --}}
        <div>
            <label for="start_time">開始日付</label>
            <input type="datetime" name="start_time_date" id="start_time_date">
        </div>
        <div>
            <label for="start_time">開始時刻</label>
            <input type="time" name="start_time_time" id="start_time_time">
        </div>
        {{-- 終了日時 --}}
        <div>
            <label for="end_time">終了日付</label>
            <input type="datetime" name="end_time_date" id="end_time_date">
        </div>
        <div>
            <label for="end_time">終了時刻</label>
            <input type="time" name="end_time_time" id="end_time_time">
        </div>
        <button type="submit">登録</button>
    </form>
</body>
</html>
