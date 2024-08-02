<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席予約</title>
</head>
<body>
    <form action="{{ route('admin.reservations.store') }}" method="POST">
        @csrf
        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" id="name">
        </div>
        <button type="submit">登録</button>
    </form>
</body>
</html>
