<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Webová aplikácia na správu inventára auto-dielov v Laraveli">
    <meta name="keywords" content="laravel, inventar, auto, diely">
    <meta name="author" content="Bc. Lukáš Maár">
    <meta name="robots" content="index, follow">
    <title>@yield('title', 'AutoDiely')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('cars.index') }}">AutoDiely</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('cars.index') }}">Autá</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('parts.index') }}">Diely</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
