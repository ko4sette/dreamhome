<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'DreamHome' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
<header class="sticky top-0 z-50 backdrop-blur-xl bg-white/70 border-b border-black/5">

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

                @if(auth()->user()->role === 'client')
                    <a href="{{ route('client.home') }}"
                       class="hover:text-neutral-500 transition">
                       Client
                    </a>
                @endif

                @if(auth()->user()->role === 'staff')
                    <a href="{{ route('staff.home') }}"
                       class="hover:text-neutral-500 transition">
                       Staff
                    </a>
                @endif

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.home') }}"
                       class="hover:text-neutral-500 transition">
                       Admin
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

                    <div>
                        <div class="text-sm font-semibold leading-none">
                            {{ auth()->user()->name }}
                        </div>

                        <div class="text-xs text-neutral-500 capitalize mt-1">
                            {{ auth()->user()->role }}
                        </div>
                    </div>

                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="px-5 py-2.5 rounded-full border border-neutral-300 hover:bg-white transition text-sm font-medium">
                        Logout
                    </button>
                </form>

            @endguest

        </div>
    </div>
</header>

<main class="min-h-screen">
    @yield('content')
</main>

<footer class="bg-neutral-950 text-neutral-300 mt-24">

    <div class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-3 gap-12">

        <div>
            <h3 class="text-xl font-bold mb-4">DreamHome</h3>

            <p class="text-sm leading-7 text-neutral-500">
                A modern property rental management platform built with Laravel and PostgreSQL.
            </p>
        </div>

        <div>
            <h4 class="font-semibold mb-4">Navigation</h4>

            <div class="space-y-3 text-sm text-neutral-500">

                <div>
                    <a href="{{ route('home') }}" class="hover:text-white transition">
                        Home
                    </a>
                </div>

                <div>
                    <a href="{{ route('properties.index') }}" class="hover:text-white transition">
                        Properties
                    </a>
                </div>

            </div>
        </div>

        <div>
            <h4 class="font-semibold mb-4">System</h4>

            <div class="space-y-3 text-sm text-neutral-500">
                <div>Laravel + PostgreSQL</div>
                <div>Property Management Module</div>
                <div>Client, Staff, Admin Roles</div>
            </div>
        </div>

    </div>

    <div class="border-t border-white/10 py-6 text-center text-xs text-neutral-600">
        © {{ date('Y') }} DreamHome. All rights reserved.
    </div>

</footer>

</body>
</html>