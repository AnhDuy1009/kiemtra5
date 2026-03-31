<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'Quản lý sách' }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f7f6; }
        .main-content { padding: 20px; }
    </style>
</head>
<body>
    <div class="main-content">
        {{ $slot }}
    </div>
</body>
</html>