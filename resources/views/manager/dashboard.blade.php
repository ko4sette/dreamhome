<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#3E4E35] leading-tight">
            {{ __('Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#E2DFCF] overflow-hidden shadow-lg sm:rounded-lg border border-[#DFDCCD]">
                <div class="p-6 text-[#3E4E35] font-medium">
                    {{ __("Welcome to the Manager Dashboard!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>