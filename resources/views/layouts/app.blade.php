<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @stack('styles')
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @if (Route::has('login'))
                    @auth
                        @livewire('navigation-menu')
                    @else
                    <div class="px-6 py-4 sm:block relative flex items-top justify-center h-10  sm:items-center sm:pt-0">
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                        
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    </div>
                    @endauth
            @endif
           

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            {{--<main class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                {{ $slot }}
            </main>--}}

            <div class="flex flex-col flex-1">
                <main class="relative z-0 flex-1 min-h-screen focus:outline-none" tabindex="0" x-data="" x-init="$el.focus()">
                    <div class="pb-6 mx-auto max-w-7xl sm:px-6 lg:px-7">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        @stack('modals')
        @livewireScripts
        @stack('scripts')
    </body>
</html>
