<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-[#DFDCCD]">
            @auth
                <div class="flex min-h-screen">
                    @include('layouts.partials.sidebar')
                    <div class="flex-1">
                        @include('layouts.navigation')

                        @isset($header)
                            <header class="bg-[#E2DFCF] shadow">
                                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                    {{ $header }}
                                </div>
                            </header>
                        @endisset

                        <main class="p-6 md:p-8 lg:p-10">
                            {{ $slot }}
                        </main>
                    </div>
                </div>
            @else
                @include('layouts.navigation')

                @isset($header)
                    <header class="bg-[#E2DFCF] shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main>
                    {{ $slot }}
                </main>
            @endauth
        </div>
    </body>
</html>
