<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席予約編集</title>
</head>
<body>
    <form action="{{ route('admin.reservations.update', ['reservation' => $reservation]) }}" method="POST">
        @method('PATCH')
        @csrf
        <input type="hidden" name="movie_id" value="{{ $reservation->schedule->movie->id }}">
        <input type="hidden" name="schedule_id" value="{{ $reservation->schedule_id }}">
        <input type="hidden" name="sheet_id" value="{{ $reservation->sheet_id }}">
        <input type="hidden" name="date" value="{{ $reservation->date }}">
        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ $reservation->email }}">
        </div>
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" id="name" value="{{ $reservation->name }}">
        </div>
        <button type="submit">登録</button>
    </form>
</body>
</html>
