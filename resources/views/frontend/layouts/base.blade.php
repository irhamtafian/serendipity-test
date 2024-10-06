<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <title>
        @yield('title')
    </title>

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/aos.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery-nao-calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery-pseudo-ripple.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/revolution/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/revolution/layers.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/revolution/navigation.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

</head>
<body>
<main>
    <header class="style3 w-100">
        @include("frontend.layouts.header-menubar")
    </header>

    @include("frontend.layouts.header-sticky")

    @include("frontend.layouts.header-responsive")

    @yield('content')

    @include("frontend.layouts.copyright")
</main>

@include("frontend.layouts.script")

</body>
</html>