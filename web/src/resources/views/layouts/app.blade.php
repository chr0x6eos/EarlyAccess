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
        <x-jet-banner />
        @livewire('navigation-menu')

        <!-- Page Heading -->
        {{-- <header class="d-flex py-3 bg-white shadow-sm border-bottom">
            <div class="container">
                {{ $header }}
            </div>
        </header>
        --}}

        <!-- Page Content -->
        <main class="container my-5">
            @if(isset($slot))
            {{ $slot }}
            @endif
            @yield('content')

            <!-- Error Message -->
            @if($errors)
                @foreach ($errors->all() as $error)
                    <div id="toast-alert-container" class="toast-top-center example">
                        <div id="alert" class="toast-alert alert-danger hide" role="alert" data-delay="5000" data-autohide="true" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header-alert">
                                <i class="fas fa-2x fa-exclamation-circle mr-2"></i>
                                <strong class="mr-auto">Error</strong>
                            </div>
                            <div class="toast-body">
                                {{ $error }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <!-- Success Message -->
            @if (session()->has('success'))
                <div id="toast-alert-container" class="toast-top-center example">
                    <div id="success" class="toast-alert alert-success hide" role="alert" data-delay="5000" data-autohide="true" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header-alert">
                            <i class="far fa-2x fa-thumbs-up mr-2"></i>
                            <strong class="mr-auto">Success</strong>
                            <div class="toast-body">
                                {{ session()->get('success') }}
                            </div>
                        </div>
                        <div class="toast-body">

                        </div>
                    </div>
                </div>
            @endif
        </main>

        @stack('modals')

        @livewireScripts

        @stack('scripts')
    </body>
</html>
