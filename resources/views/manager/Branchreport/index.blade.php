<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#3E4E35] leading-tight">
            {{ __('Branch Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#E2DFCF] overflow-hidden shadow-lg sm:rounded-lg border border-[#DFDCCD]">
                <div class="p-6">
                    <p class="text-[#3E4E35] font-bold text-xl mb-4">Branch Performance & Metrics</p>
                    
                    <!-- Placeholder Data Area -->
                    <div class="bg-white rounded-xl p-12 text-center border-2 border-dashed border-gray-300">
                        <div class="text-4xl mb-4">📊</div>
                        <h3 class="text-lg font-medium text-gray-900">Awaiting Report Data</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Analytical charts and regional branch reports will be displayed here once connected to the database.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
