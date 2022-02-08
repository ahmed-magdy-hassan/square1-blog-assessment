<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

       <!-- Fonts -->
       <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

       <!-- Styles -->
       <link rel="stylesheet" href="{{ mix('css/app.css') }}">
       @stack('styles')
       @livewireStyles

       <!-- Scripts -->
       <script src="{{ mix('js/app.js') }}" defer></script>

    </head>
    <body class="antialiased bg-gray-100">
        @if (Route::has('login'))
            <div class="px-6 py-4 sm:block relative flex items-top justify-center h-10  sm:items-center sm:pt-0">
                @auth
                    <a href="{{ route('posts.index') }}" class="text-sm text-gray-700 underline">My Posts</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif


        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <header class="pt-16 pb-9 sm:pb-16 sm:text-center">
                <h1 class="mb-4 text-3xl sm:text-4xl tracking-tight text-slate-900 font-extrabold dark:text-slate-700">Blog</h1>
                <p class="text-lg text-slate-700 dark:text-slate-400">All the latest news, straight from our website.</p>
            </header>
            
            <livewire:guest.posts.index />
        </div>

        @stack('modals')
        @livewireScripts
        @stack('scripts')
    </body>
</html>
