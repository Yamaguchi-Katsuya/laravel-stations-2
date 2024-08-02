<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>予約一覧</title>
</head>
<body>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <table>
        <tr>
            <th>映画タイトル</th>
            <th>座席</th>
            <th>日時</th>
            <th>名前</th>
            <th>メールアドレス</th>
        </tr>
        @foreach ($reservations as $reservation)
        @if ($reservation->schedule->end_time < now())
            @continue
        @endif
        <tr>
            <td>{{ $reservation->schedule->movie->title }}</td>
            <td>{{ strtoupper($reservation->sheet->row.$reservation->sheet->column) }}</td>
            <td>{{ $reservation->date }}</td>
            <td>{{ $reservation->name }}</td>
            <td>{{ $reservation->email }}</td>
            <td><a href="{{ route('admin.reservations.edit', ['reservation' => $reservation->id]) }}">編集</a></td>
            <td>
                <form action="{{ route('admin.reservations.destroy', ['reservation' => $reservation->id]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" onclick="return confirm('削除しますか？')">削除</button>
                </form>
        </tr>
        @endforeach
    </table>
</body>
</html>
