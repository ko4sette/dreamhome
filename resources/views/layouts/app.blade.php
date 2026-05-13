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
        <div class="min-h-screen bg-gray-100">
            <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">

                <a href="{{ route('home') }}"
                   class="text-2xl font-extrabold tracking-tight">
                    DreamHome
                </a>

                <nav class="hidden md:flex items-center gap-8 text-sm font-medium">

                    <a href="{{ route('home') }}"
                       class="hover:text-neutral-500 transition">
                       Home
                    </a>

                    <a href="{{ route('properties.index') }}"
                       class="hover:text-neutral-500 transition">
                       Properties
                    </a>

                    @auth

                        {{-- CLIENT NAV --}}
                        @if(auth()->user()->role === 'client')
                            <a href="{{ route('client.home') }}"
                               class="hover:text-neutral-500 transition">
                               Client
                            </a>
                            <a href="{{ route('feedback.create') }}"
                               class="hover:text-neutral-500 transition">
                               Rate Property
                            </a>
                        @endif

                        {{-- STAFF NAV --}}
                        @if(auth()->user()->role === 'staff')
                            <a href="{{ route('staff.home') }}"
                               class="hover:text-neutral-500 transition">
                               Staff
                            </a>

                            <a href="{{ route('viewings.index') }}"
                               class="{{ request()->routeIs('viewings.*') ? 'text-neutral-900 font-semibold' : 'hover:text-neutral-500' }} transition">
                               Viewings
                            </a>

                            <a href="{{ route('feedback.index') }}"
                               class="{{ request()->routeIs('feedback.*') ? 'text-neutral-900 font-semibold' : 'hover:text-neutral-500' }} transition">
                               Feedback
                            </a>

                            <a href="{{ route('contracts.index') }}"
                               class="{{ request()->routeIs('contracts.*') ? 'text-neutral-900 font-semibold' : 'hover:text-neutral-500' }} transition">
                               Contracts
                            </a>
                        @endif

                        {{-- ADMIN NAV --}}
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.home') }}"
                               class="hover:text-neutral-500 transition">
                               Admin
                            </a>

                            <a href="{{ route('viewings.index') }}"
                               class="{{ request()->routeIs('viewings.*') ? 'text-neutral-900 font-semibold' : 'hover:text-neutral-500' }} transition">
                               Viewings
                            </a>

                            <a href="{{ route('feedback.index') }}"
                               class="{{ request()->routeIs('feedback.*') ? 'text-neutral-900 font-semibold' : 'hover:text-neutral-500' }} transition">
                               Feedback
                            </a>

                            <a href="{{ route('contracts.index') }}"
                               class="{{ request()->routeIs('contracts.*') ? 'text-neutral-900 font-semibold' : 'hover:text-neutral-500' }} transition">
                               Contracts
                            </a>
                        @endif

                    @endauth
                </nav>

                <div class="flex items-center gap-3">

                    @guest

                        <a href="{{ route('login') }}"
                           class="px-5 py-2.5 rounded-full border border-neutral-300 hover:bg-white transition text-sm font-medium">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                           class="px-5 py-2.5 rounded-full bg-neutral-900 text-white hover:bg-neutral-800 transition text-sm font-medium shadow-lg">
                            Register
                        </a>

                    @else

                        <div class="hidden sm:flex items-center gap-3">

                            <div class="w-10 h-10 rounded-full bg-neutral-900 text-white flex items-center justify-center font-semibold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                        class="px-5 py-2.5 rounded-full border border-neutral-300 hover:bg-white transition text-sm font-medium">
                                    Logout
                                </button>
                            </form>
                        </div>

                    @endguest
                </div>
            </div>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
