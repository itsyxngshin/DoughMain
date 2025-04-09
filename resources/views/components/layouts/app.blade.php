<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Load Vite -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @yield('log_screen')
    @yield('screen-verification')
    @livewireScripts
</body>
</html>