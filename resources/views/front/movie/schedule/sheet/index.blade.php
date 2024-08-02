<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>
    <h1>座席一覧</h1>
    <table>
        <thead>
            <tr>
                <th colspan="5">スクリーン</th>
            </tr>
        </thead>
        <tbody>
            {{-- sheetsを5列ごとに分割して表示 --}}
            @foreach ($sheets->chunk(5) as $chunk)
                <tr>
                    @foreach ($chunk as $sheet)
                        <td>
                            @if ($sheet->is_available)
                                <a href="{{ route('reservations.create', [
                                    'movieId' => $movieId,
                                    'scheduleId' => $scheduleId,
                                    'sheetId' => $sheet->id,
                                    'date' => $date
                                ]) }}">
                                {{ strtoupper($sheet->row) . $sheet->column }}
                                </a>
                            @else
                                <span style="background-color: lightgray">{{ strtoupper($sheet->row) . $sheet->column }}</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
