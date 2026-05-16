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
                    <aside class="min-h-screen w-72 bg-[#3E4E35] text-slate-100 shadow-2xl flex flex-col justify-between">
                        <div>
                            <div class="p-6">
                                <h2 class="text-3xl font-extrabold tracking-wider">DreamHome</h2>
                            </div>

                            @php
                                $role = auth()->user()->role;
                                $active = fn ($pattern) => request()->routeIs($pattern) || request()->is(str_replace('.*', '/*', $pattern));
                            @endphp

                            <nav class="mt-8 space-y-6">
                                @switch($role)
                                    @case('admin')
                                        <div class="px-6 text-xs font-semibold uppercase tracking-wider text-neutral-400">Admin Menu</div>

                                        <a href="{{ route('admin.home') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('admin.*') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                                            <span class="mr-3">🏠</span>
                                            Dashboard
                                        </a>
                                        @break

                                    @case('manager')
                                        <div class="px-6 text-xs font-semibold uppercase tracking-wider text-neutral-400">Manager Menu</div>

                                        <a href="{{ route('manager.dashboard') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('manager.*') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                                            <span class="mr-3">📊</span>
                                            Dashboard
                                        </a>
                                        @break

                                    @case('supervisor')
                                        <div class="px-6 text-xs font-semibold uppercase tracking-wider text-neutral-400">Supervisor Menu</div>

                                        <a href="{{ route('supervisor.dashboard') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('supervisor.*') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                                            <span class="mr-3">🧭</span>
                                            Dashboard
                                        </a>
                                        @break

                                    @case('secretary')
                                        <div class="px-6 text-xs font-semibold uppercase tracking-wider text-neutral-400">Secretary Menu</div>

                                        <a href="{{ route('secretary.dashboard') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('secretary.*') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                                            <span class="mr-3">🗂️</span>
                                            Dashboard
                                        </a>
                                        @break

                                    @case('staff')
                                        <div class="px-6 text-xs font-semibold uppercase tracking-wider text-neutral-400">Staff Menu</div>

                                        <a href="{{ route('staff.dashboard') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('staff.dashboard') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                                            <span class="mr-3">🏠</span>
                                            Dashboard
                                        </a>

                                        <div class="mt-4 px-6 text-xs font-semibold uppercase tracking-wider text-neutral-400">Property Management</div>

                                        <a href="{{ route('staff.properties.index') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('staff.properties.*') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                                            <span class="mr-3">🏘️</span>
                                            Properties
                                        </a>
                                        @break

                                    @default
                                        <div class="px-6 text-xs font-semibold uppercase tracking-wider text-neutral-400">Navigation</div>
                                        <a href="{{ route('home') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('home') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                                            <span class="mr-3">🏠</span>
                                            Home
                                        </a>
                                @endswitch
                            </nav>
                        </div>
                    </aside>
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
