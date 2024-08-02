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
            @foreach (['a', 'b', 'c'] as $row)
                <tr>
                    @foreach (range(1, 5) as $col)
                        <td>{{ $row }}-{{ $col }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
