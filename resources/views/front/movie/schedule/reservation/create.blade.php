<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席予約</title>
</head>
<body>
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="movie_id" value="{{ $movieId }}">
        <input type="hidden" name="schedule_id" value="{{ $scheduleId }}">
        <input type="hidden" name="sheet_id" value="{{ $sheetId }}">
        <input type="hidden" name="date" value="{{ $date }}">
        <div>
            <label for="email">メールアドレス</label>
            <span>{{ auth()->user()->email }}</span>
        </div>
        <div>
            <label for="name">名前</label>
            <span>{{ auth()->user()->name }}</span>
        </div>
        <button type="submit">登録</button>
    </form>
</body>
</html>
