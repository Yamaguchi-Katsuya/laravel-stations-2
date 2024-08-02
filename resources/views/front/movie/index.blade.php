<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>
    <h1>映画一覧</h1>
    {{-- 検索フォーム --}}
    <form action="{{ route('movies.index') }}" method="get">
        <div>
            <label for="title">キーワード</label>
            <input type="text" name="keyword" id="keyword" value="{{ $keyword }}">
        </div>
        <div>
            <input type="radio" name="is_showing" id="all" value="" {{ !$is_showing ? 'checked' : '' }}>
            <label for="all">すべて</label>
            <input type="radio" name="is_showing" id="showing" value="1" {{ $is_showing === '1' ? 'checked' : '' }}>
            <label for="showing">公開中</label>
            <input type="radio" name="is_showing" id="not-showing" value="0" {{ $is_showing === '0' ? 'checked' : '' }}>
            <label for="not-showing">公開予定</label>
        </div>
        <button type="submit">検索</button>
    </form>
    <ul>
    @foreach ($movies as $movie)
        <li>映画タイトル: {{ $movie->title }}</li>
        <li>画像URL: {{ $movie->image_url }}</li>
        <li>公開フラグ: {{ $movie->is_showing ? '公開中' : '公開予定' }}</li>
        <h3>スケジュール一覧</h3>
        <ul>
        @foreach ($movie->schedules as $schedule)
            <li>上映日時: {{ $schedule->start_time }} 〜 {{ $schedule->end_time }}</li>
            <li>
                <a href="{{ route('movies.schedules.sheets.index', [
                    'movieId' => $movie->id,
                    'scheduleId' => $schedule->id,
                    'date' => now()->format('Y-m-d')
                ]) }}">座席予約</a>
            </li>
        @endforeach
        </ul>
    @endforeach
    </ul>
    {{ $movies->appends(['keyword' => $keyword, 'is_showing' => $is_showing])->links() }}
</body>
</html>
