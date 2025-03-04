<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa hồ sơ</title>
</head>
<body>
    <h1>Chỉnh sửa hồ sơ</h1>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <label for="name">Tên:</label>
        <input type="text" name="name" value="{{ auth()->user()->name }}">
        
        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
