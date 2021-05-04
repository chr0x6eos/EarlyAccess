<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ mix('css/nunito.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased bg-light">
<div class="container-fluid fixed-top p-4">
    <div class="col-12">
        <div class="d-flex justify-content-end">
            @if (Route::has('login'))
                <div class="">
                @auth
                        <a href="{{ url('/dashboard') }}" class="text-muted">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-muted">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-muted">Register</a>
                    @endif
                @endif
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>
