<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
    <style>
        body {
            background: url("{{ asset('gunung.jpeg') }}") no-repeat center center fixed;
            background-size: cover;
        }
        .bg-overlay {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            border-radius: 10px;
            padding: 20px;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="bg-overlay">
        @yield('content')
    </div>

    <script src="{{ asset('assets/jquery-3.6.1.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.min.js') }}"></script>
</body>
</html>
