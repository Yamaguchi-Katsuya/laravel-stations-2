<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール一覧</title>
</head>
<body>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    @foreach ($movies as $movie)
        <h2>作品・{{ $movie->id}},{{ $movie->title}}</h2>
        @foreach ($movie->schedules as $schedule)
            <p>
                <a href="{{ route('admin.schedules.edit', ['id' => $schedule->id]) }}">{{ $schedule->start_time }} ~ {{ $schedule->end_time }}</a>
            </p>
        @endforeach
    @endforeach
</body>
</html>
