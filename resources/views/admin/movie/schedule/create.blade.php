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
        {{-- スクリーン --}}
        <div>
            <label for="screen_id">スクリーン</label>
            <select name="screen_id" id="screen_id">
                @foreach ($screens as $screen)
                    <option value="{{ $screen->id }}" {{ old('screen_id') == $screen->id ? 'selected' : '' }}>
                        {{ $screen->name }}
                    </option>
                @endforeach
            </select>
            @error('screen_id')
                <span>{{ $message }}</span>
            @enderror
        </div>
        {{-- 開始日時 --}}
        <div>
            <label for="start_time">開始日付</label>
            <input type="date" name="start_time_date" id="start_time_date" value="{{ old('start_time_date') }}">
            @error('start_time_date')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="start_time">開始時刻</label>
            <input type="time" name="start_time_time" id="start_time_time" value="{{ old('start_time_time') }}">
            @error('start_time_time')
                <span>{{ $message }}</span>
            @enderror
        </div>
        {{-- 終了日時 --}}
        <div>
            <label for="end_time">終了日付</label>
            <input type="date" name="end_time_date" id="end_time_date" value="{{ old('end_time_date') }}">
            @error('end_time_date')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="end_time">終了時刻</label>
            <input type="time" name="end_time_time" id="end_time_time" value="{{ old('end_time_time') }}">
            @error('end_time_time')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">登録</button>
    </form>
</body>
</html>
