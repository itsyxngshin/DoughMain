<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DoughMain')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])  {{-- Use Tailwind via Vite --}}
    @livewireStyles
</head>
<body class="@yield('body-class', 'bg-gray-100 min-h-screen flex items-center justify-center')">
    @yield('content')
    @livewireScripts
</body>
</html>