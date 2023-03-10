<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- Style --}}
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}">

    {{-- Favicon --}}
    <link rel="shortcut" href="{{ url('assets/img/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ url('assets/img/favicon.png') }}" type="image/x-icon">

</head>

<body class="@yield('bodyclass')">
    @yield('navbar')

    <div class="content @yield('contentclass')">
        @yield('content')
    </div>

    @yield('other')

    {{-- Script --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @yield('extrajs')
</body>

</html>
