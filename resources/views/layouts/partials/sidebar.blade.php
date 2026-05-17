<aside class="min-h-screen w-72 bg-[#3E4E35] text-slate-100 shadow-2xl flex flex-col justify-between">
    <div>
        <div class="p-6">
            <h2 class="text-3xl font-extrabold tracking-tight" style="color: #E2DFCF;">DreamHome</h2>
        </div>

        @php
            $role = auth()->user()->role;
            $active = fn ($pattern) => request()->routeIs($pattern) || request()->is(str_replace('.*', '/*', $pattern));
        @endphp

        <nav class="mt-8 space-y-6">
            @switch($role)
                @case('admin')
                    
                    <a href="{{ route('admin.home') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition text-xs font-semibold uppercase tracking-wider text-neutral-400 {{ $active('admin.*') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                        Dashboard
                    </a>
                    @break

                @case('manager')
        
                    <a href="{{ route('manager.dashboard') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition text-xs font-semibold uppercase tracking-wider text-neutral-400 {{ $active('manager.dashboard') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                        Home
                    </a>
                    <a href="{{ route('manager.StaffManagement.index') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition text-xs font-semibold uppercase tracking-wider text-neutral-400 {{ $active('manager.StaffManagement.*') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                        Staff Management
                    </a>
                    <a href="{{ route('manager.Branchreport.index') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition text-xs font-semibold uppercase tracking-wider text-neutral-400 {{ $active('manager.Branchreport.*') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                        Branch Reports
                    </a>
                    <a href="{{ route('manager.StaffReport.index') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition text-xs font-semibold uppercase tracking-wider text-neutral-400 {{ $active('manager.StaffReport.*') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                        Staffs Records
                    </a>
                    @break

                @case('supervisor')

                    <a href="{{ route('supervisor.dashboard') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition text-xs font-semibold uppercase tracking-wider text-neutral-400 {{ $active('supervisor.dashboard') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                        Home
                    </a>
                    <a href="{{ route('supervisor.properties.create') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition text-xs font-semibold uppercase tracking-wider text-neutral-400 {{ $active('supervisor.properties.create') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                        Staffs Management
                    </a>
                    <a href="{{ route('supervisor.properties.index') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition text-xs font-semibold uppercase tracking-wider text-neutral-400 {{ $active('supervisor.properties.index') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                        Property Management
                    </a>
                    @break

                @case('secretary')
                    <a href="{{ route('secretary.dashboard') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition text-xs font-semibold uppercase tracking-wider text-neutral-400 {{ $active('secretary.dashboard') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                        Home
                    </a>
                    @break

                @case('staff')
                    <a href="{{ route('staff.dashboard') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition text-xs font-semibold uppercase tracking-wider text-neutral-400 {{ $active('staff.dashboard') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                        Home
                    </a>
                    <a href="{{ route('staff.properties.index') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition text-xs font-semibold uppercase tracking-wider text-neutral-400 {{ $active('staff.properties.*') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                        Property
                    </a>
                    @break

                @default
                    <div class="px-6 text-xs font-semibold uppercase tracking-wider text-neutral-400">Navigation</div>
                    <a href="{{ route('home') }}" class="flex items-center px-6 py-3 mx-4 rounded-lg transition text-xs font-semibold uppercase tracking-wider text-neutral-400 {{ $active('home') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                        Home
                    </a>
            @endswitch
        </nav>
    </div>
</aside>