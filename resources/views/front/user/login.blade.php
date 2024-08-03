<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email">{{ __('Email') }}</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password">
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="ml-3">
                ログイン
            </button>
        </div>
    </form>

    <div class="flex items-center justify-end mt-4">
        <button type="submit" class="ml-3" onclick="location.href='{{ route('users.create') }}'">
            新規登録
        </button>
    </div>
</body>
</html>
