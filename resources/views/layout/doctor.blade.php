<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Dokter')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head')
</head>
<body class="auth-body">
<!-- Navigation Bar -->
@include('component.navbarDoctor')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 px-0">
            @include('component.sidebarDoctor')
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            @yield('content')
        </div>
    </div>
</div>

{{-- Global Modals --}}
@yield('modals')
</body>
</html>
