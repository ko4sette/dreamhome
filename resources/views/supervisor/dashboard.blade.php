<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#3E4E35] leading-tight">
            {{ __('Supervisor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Dashboard Header -->
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-[#3E4E35]">Overview</h3>
                <p class="text-sm text-[#3E4E35] opacity-70">Key metrics for your supervised team and properties.</p>
            </div>

            <!-- Metrics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Team Size Card -->
                <div class="bg-[#DFDCCD] overflow-hidden shadow-lg rounded-xl border border-[#3E4E35] transition-transform duration-300 hover:-translate-y-1">
                    <div class="p-6 flex flex-col justify-between h-full">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-bold text-[#3E4E35] uppercase tracking-wider">Branch Staff</h4>
                            <div class="bg-[#3E4E35] text-[#DFDCCD] p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-4xl font-extrabold text-[#3E4E35]">{{ $teamSize ?? 0 }}</p>
                            <p class="text-sm font-medium text-[#3E4E35] opacity-70 mt-1">Total in branch</p>
                        </div>
                    </div>
                </div>

                <!-- Managed Properties Card -->
                <div class="bg-[#DFDCCD] overflow-hidden shadow-lg rounded-xl border border-[#3E4E35] transition-transform duration-300 hover:-translate-y-1">
                    <div class="p-6 flex flex-col justify-between h-full">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-bold text-[#3E4E35] uppercase tracking-wider">Properties</h4>
                            <div class="bg-[#3E4E35] text-[#DFDCCD] p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-4xl font-extrabold text-[#3E4E35]">{{ $managedProperties ?? 0 }}</p>
                            <p class="text-sm font-medium text-[#3E4E35] opacity-70 mt-1">Under management</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>