<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>
    <form action="{{ route('admin.movies.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">映画タイトル</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
            @error('title')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="image_url">画像URL</label>
            <input type="text" name="image_url" id="image_url" value="{{ old('image_url') }}" required>
            @error('image_url')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="published_year">公開年</label>
            <input type="number" name="published_year" id="published_year" value="{{ old('published_year') }}" required>
            @error('published_year')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="is_showing">公開中かどうか</label>
            <input type="checkbox" name="is_showing" id="is_showing" value="1" {{ old('is_showing') ? 'checked' : '' }}>
            @error('is_showing')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="description">概要</label>
            <textarea name="description" id="description" required>{{ old('description') }}</textarea>
            @error('description')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="genre">ジャンル</label>
            <input type="text" name="genre" id="genre" value="{{ old('genre') }}" required>
        </div>
        <button type="submit">登録</button>
    </form>
</body>
</html>
