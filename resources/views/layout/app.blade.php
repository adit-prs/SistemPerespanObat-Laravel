<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Login')</title>

    {{-- Include compiled CSS from Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="guest-body">
    @yield('content')
</body>
</html>
