<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-[#3E4E35] leading-tight">
                {{ __('Staffs Records') }}
            </h2>
            <button class="bg-[#3E4E35] hover:bg-opacity-90 text-white font-bold py-2 px-4 rounded shadow transition">
                + Add Next of Kin
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#E2DFCF] overflow-hidden shadow-lg sm:rounded-lg border border-[#DFDCCD]">
                <div class="p-6">
                    <p class="text-[#3E4E35] font-bold text-xl mb-4">Emergency Contacts & Next of Kin</p>
                    
                    <!-- Placeholder Data Area -->
                    <div class="bg-white rounded-xl p-12 text-center border-2 border-dashed border-gray-300">
                        <div class="text-4xl mb-4">📁</div>
                        <h3 class="text-lg font-medium text-gray-900">No Records Available</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Detailed staff emergency records and Next of Kin information will be securely accessible here.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
