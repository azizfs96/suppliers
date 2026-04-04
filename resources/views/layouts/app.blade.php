<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full scroll-smooth bg-[#121212]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="dark">
    <title>@yield('title', config('app.name', 'Azir Suppliers'))</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cairo:400,500,600,700|amiri:700,400&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/css/ui.css', 'resources/js/app.js'])
</head>
<body class="@yield('body-class', 'app-body')">
    @yield('body')
</body>
</html>
