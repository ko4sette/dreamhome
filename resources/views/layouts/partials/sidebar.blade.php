<div class="min-h-screen w-72 bg-[#3E4E35] text-sidebar-text shadow-2xl flex flex-col justify-between">
    <div>
        <div class="p-6">
            <h2 class="text-2xl font-extrabold tracking-tight">DreamHome</h2>

        </div>

        @auth
            @php
                $role = auth()->user()->role;
                $active = fn ($pattern) => request()->routeIs($pattern) || request()->is(str_replace('.*', '/*', $pattern));
            @endphp

            <nav class="mt-8 space-y-6">
                @switch($role)
                    @case('admin')
                        <div class="px-6 text-xs font-semibold uppercase tracking-wider text-neutral-500">Admin Menu</div>

                        <a href="{{ route('admin.home') }}"
                           class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('admin.*') ? 'bg-black/20' : 'hover:bg-black/10' }}">
                            <span class="mr-3">🏠</span>
                            Dashboard
                        </a>
                        @break

                    @case('manager')
                        <div class="px-6 text-xs font-semibold uppercase tracking-wider text-neutral-500">Manager Menu</div>

                        <a href="{{ route('manager.dashboard') }}"
                           class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('manager.*') ? 'bg-black/20' : 'hover:bg-black/10' }}">
                            <span class="mr-3">📊</span>
                            Dashboard
                        </a>
                        @break

                    @case('supervisor')
                        <div class="px-6 text-xs font-semibold uppercase tracking-wider text-neutral-500">Supervisor Menu</div>

                        <a href="{{ route('supervisor.dashboard') }}"
                           class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('supervisor.*') ? 'bg-black/20' : 'hover:bg-black/10' }}">
                            <span class="mr-3">🧭</span>
                            Dashboard
                        </a>
                        @break

                    @case('secretary')
                        <div class="px-6 text-xs font-semibold uppercase tracking-wider text-neutral-500">Secretary Menu</div>

                        <a href="{{ route('secretary.dashboard') }}"
                           class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('secretary.*') ? 'bg-black/20' : 'hover:bg-black/10' }}">
                            <span class="mr-3">🗂️</span>
                            Dashboard
                        </a>
                        @break

                    @case('staff')
                        <div class="px-6 text-xs font-semibold uppercase tracking-wider text-neutral-500">Staff Menu</div>

                        <a href="{{ route('staff.dashboard') }}"
                           class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('staff.dashboard') ? 'bg-black/20' : 'hover:bg-black/10' }}">
                            <span class="mr-3">🏠</span>
                            Dashboard
                        </a>

                        <div class="mt-4 px-6 text-xs font-semibold uppercase tracking-wider text-neutral-500">Property Management</div>

                        <a href="{{ route('staff.properties.index') }}"
                           class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('staff.properties.*') ? 'bg-black/20' : 'hover:bg-black/10' }}">
                            <span class="mr-3">🏘️</span>
                            Properties
                        </a>
                        @break

                    @default
                        <div class="px-6 text-xs font-semibold uppercase tracking-wider text-neutral-500">Navigation</div>
                        <a href="{{ route('home') }}"
                           class="flex items-center px-6 py-3 mx-4 rounded-lg transition {{ $active('home') ? 'bg-black/20' : 'hover:bg-black/10' }}">
                            <span class="mr-3">🏠</span>
                            Home
                        </a>
                @endswitch
            </nav>
        @else
            <div class="px-6 py-4 text-sm text-neutral-400">
                Please log in.
            </div>
        @endauth
    </div>
</div>