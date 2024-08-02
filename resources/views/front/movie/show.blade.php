<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画詳細</title>
</head>
<body>
    <h1>映画詳細</h1>
    <p>映画タイトル: {{ $movie->title }}</p>
    <p>画像URL: {{ $movie->image_url }}</p>
    {{-- published_year --}}
    <p>公開年: {{ $movie->published_year }}</p>
    <p>公開フラグ: {{ $movie->is_showing ? '公開中' : '公開予定' }}</p>
    <p>概要: {{ $movie->description }}</p>
    <p>ジャンル: {{ $movie->genre->name }}</p>
    <a href="{{ route('movies.index') }}">一覧に戻る</a>
    <h2>スケジュール一覧</h2>
    @foreach ($movie->schedules as $schedule)
        <p>
            <a href="{{ route('admin.schedules.edit', ['id' => $schedule->id]) }}">{{ $schedule->start_time }} ~ {{ $schedule->end_time }}</a>
        </p>
        {{-- 座席予約ボタン /movies/{movie_id}/schedules/{schedule_id}/sheet --}}
        <a href="{{ route('movies.schedules.sheets.index', ['movieId' => $movie->id, 'scheduleId' => $schedule->id, 'date' => now()->format('Y-m-d')]) }}">座席を予約する</a>
    @endforeach
</body>
</html>
