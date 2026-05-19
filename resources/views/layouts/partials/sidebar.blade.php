<aside class="fixed top-0 left-0 flex min-h-screen w-72 flex-col justify-between bg-[#3E4E35] text-slate-100 shadow-2xl">
    <div>
        <div class="p-6 border-b border-slate-300/10">
            <a href="{{ route('dashboard') }}" class="text-3xl font-extrabold tracking-tight" style="color: #E2DFCF;">
                DreamHome
            </a>
        </div>

        <div class="p-6">
            <a href="{{ route('profile.edit') }}" class="group flex items-center gap-x-4 rounded-lg py-3 text-sm font-semibold text-white">
                <span class="flex h-20 w-20 shrink-0 items-center justify-center rounded-full bg-slate-900 text-3xl font-semibold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </span>
                <span class="flex flex-col">
                    <span>
                        {{ auth()->user()->name }}
                    </span>
                    <span class="text-xs font-medium uppercase tracking-wider text-neutral-400 bg-white/10 px-2 py-1 rounded">
                        {{ auth()->user()->role }}
                    </span>
                </span>
            </a>
        </div>

        @php
            $role = auth()->user()->role;
            $active = fn ($pattern) => request()->routeIs($pattern) || request()->is(str_replace('.*', '/*', $pattern));
        @endphp

        <nav>
            <div class="space-y-2">
                @switch($role)
                    @case('admin')
                        <a href="{{ route('admin.home') }}" class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ $active('admin.*') ? 'bg-white/10 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                            Dashboard
                        </a>
                        @break

                    @case('manager')
                        <a href="{{ route('manager.dashboard') }}" class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ $active('manager.dashboard') ? 'bg-white/10 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('manager.StaffManagement.index') }}" class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ $active('manager.StaffManagement.*') ? 'bg-white/10 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                            Staff Management
                        </a>
                        <a href="{{ route('manager.Branchreport.index') }}" class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ $active('manager.Branchreport.*') ? 'bg-white/10 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                            Branch Reports
                        </a>
                        <a href="{{ route('manager.StaffReport.index') }}" class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ $active('manager.StaffReport.*') ? 'bg-white/10 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                            Financial Records   
                        </a>
                        @break

                    @case('supervisor')
                        <a href="{{ route('supervisor.dashboard') }}" class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ $active('supervisor.dashboard') ? 'bg-white/10 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('supervisor.TeamManagement.index') }}" class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ $active('supervisor.TeamManagement.*') ? 'bg-white/10 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                            Team Management
                        </a>
                        <a href="{{ route('supervisor.PropertyManagement.index') }}" class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ $active('supervisor.PropertyManagement.*') ? 'bg-white/10 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                            Property Management
                        </a>
                        <a href="{{ route('supervisor.BranchOffice.index') }}" class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ $active('supervisor.BranchOffice.*') ? 'bg-white/10 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                            Branch Office
                        </a>
                        @break

                    @case('secretary')
                        <a href="{{ route('secretary.dashboard') }}" class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ $active('secretary.dashboard') ? 'bg-white/10 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                            Home
                        </a>
                        @break

                    @case('staff')
                        <a href="{{ route('staff.dashboard') }}" class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ $active('staff.dashboard') ? 'bg-white/10 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                            Home
                        </a>
                        <a href="{{ route('staff.properties.index') }}" class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ $active('staff.properties.*') ? 'bg-white/10 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                            Property
                        </a>
                        @break

                    @default
                        <a href="{{ route('home') }}" class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ $active('home') ? 'bg-white/10 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                            Home
                        </a>
                @endswitch
            </div>
        </nav>
    </div>

    <div class="p-6">

        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="group -mx-3.5 flex w-full items-center gap-x-3.5 rounded-lg px-3.5 py-3 text-sm font-semibold text-neutral-400 hover:bg-white/5 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 015.25 2h5.5A2.25 2.25 0 0113 4.25v2a.75.75 0 01-1.5 0v-2a.75.75 0 00-.75-.75h-5.5a.75.75 0 00-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 00.75-.75v-2a.75.75 0 011.5 0v2A2.25 2.25 0 0110.75 18h-5.5A2.25 2.25 0 013 15.75V4.25z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M6 10a.75.75 0 01.75-.75h9.546l-1.048-1.047a.75.75 0 111.06-1.06l2.5 2.5a.75.75 0 010 1.06l-2.5 2.5a.75.75 0 11-1.06-1.06L16.296 10.75H6.75A.75.75 0 016 10z" clip-rule="evenodd" />
                </svg>
                <span>
                    Logout
                </span>
            </button>
        </form>
    </div>
</aside>