{{-- user create --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新規会員登録</title>
</head>
<body>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name">名前</label>
            <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email">メールアドレス</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">パスワード</label>
            <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password">
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation">パスワード（確認）</label>
            <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                既に会員の方はこちら
            </a>

            <button type="submit" class="ml-4">
                会員登録
            </button>
        </div>
    </form>
</body>
