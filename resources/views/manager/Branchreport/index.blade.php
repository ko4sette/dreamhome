<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#3E4E35] leading-tight">
            {{ __('Global Branch Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            {{-- Global Company KPIs --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Branches -->
                <div class="bg-[#E2DFCF] rounded-xl shadow-lg border border-[#3E4E35] p-6 flex flex-col items-center text-center hover:scale-105 transition transform duration-300">
                    <div class="text-4xl mb-2 text-[#3E4E35]">🏢</div>
                    <p class="text-sm font-bold text-[#3E4E35] uppercase tracking-wider">Registered Branches</p>
                    <p class="text-4xl font-black text-[#3E4E35] mt-2">{{ $totalBranches }}</p>
                </div>

                <!-- Total Company Staff -->
                <div class="bg-[#E2DFCF] rounded-xl shadow-lg border border-[#3E4E35] p-6 flex flex-col items-center text-center hover:scale-105 transition transform duration-300">
                    <div class="text-4xl mb-2 text-[#3E4E35]">👥</div>
                    <p class="text-sm font-bold text-[#3E4E35] uppercase tracking-wider">Total Company Staff</p>
                    <p class="text-4xl font-black text-[#3E4E35] mt-2">{{ $totalCompanyStaff }}</p>
                </div>

                <!-- Total Company Properties -->
                <div class="bg-[#E2DFCF] rounded-xl shadow-lg border border-[#3E4E35] p-6 flex flex-col items-center text-center hover:scale-105 transition transform duration-300">
                    <div class="text-4xl mb-2 text-[#3E4E35]">🏡</div>
                    <p class="text-sm font-bold text-[#3E4E35] uppercase tracking-wider">Total Properties Managed</p>
                    <p class="text-4xl font-black text-[#3E4E35] mt-2">{{ $totalCompanyProperties }}</p>
                </div>
            </div>

            {{-- Branches List --}}
            <div class="space-y-10">
                @forelse($branches as $branch)
                    <div class="bg-[#E2DFCF] overflow-hidden shadow-lg rounded-xl border-2 border-[#3E4E35]">
                        
                        {{-- Branch Header --}}
                        <div class="bg-[#3E4E35] px-6 py-5 flex flex-col md:flex-row md:justify-between md:items-center">
                            <div>
                                <h3 class="text-2xl font-black text-[#DFDCCD]">{{ $branch->branch_name ?? 'Branch ' . $branch->branch_id }}</h3>
                                <p class="text-sm text-[#DFDCCD] opacity-90 mt-1">
                                    📍 {{ $branch->street }}, {{ $branch->area }}, {{ $branch->city }} {{ $branch->postcode }}
                                </p>
                            </div>
                            <div class="mt-4 md:mt-0 flex space-x-6 text-[#DFDCCD]">
                                <div class="text-center">
                                    <p class="text-xs uppercase font-bold opacity-80">Branch Staff</p>
                                    <p class="text-xl font-bold">{{ $branch->staff->count() }}</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs uppercase font-bold opacity-80">Branch Properties</p>
                                    <p class="text-xl font-bold">{{ $branch->properties->count() }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Property Portfolio --}}
                        <div class="p-6">
                            <p class="text-[#3E4E35] font-bold text-lg mb-4 border-b-2 border-[#3E4E35] pb-2 inline-block">Properties under this Branch</p>
                            
                            @if($branch->properties->count() > 0)
                                <div class="overflow-x-auto bg-[#DFDCCD] rounded-xl shadow-inner border border-[#3E4E35]">
                                    <table class="min-w-full divide-y divide-[#3E4E35]">
                                        <thead class="bg-gray-100/50">
                                            <tr>
                                                <th scope="col" class="px-5 py-3 text-left text-xs font-bold text-[#3E4E35] uppercase">Property Details</th>
                                                <th scope="col" class="px-5 py-3 text-left text-xs font-bold text-[#3E4E35] uppercase">Type & Rooms</th>
                                                <th scope="col" class="px-5 py-3 text-left text-xs font-bold text-[#3E4E35] uppercase">Monthly Rent</th>
                                                <th scope="col" class="px-5 py-3 text-left text-xs font-bold text-[#3E4E35] uppercase">Assigned Staff</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-[#3E4E35] bg-[#DFDCCD]">
                                            @foreach($branch->properties as $property)
                                                <tr class="hover:bg-[#3E4E35] hover:text-[#DFDCCD] transition group text-[#3E4E35]">
                                                    <td class="px-5 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-bold">Property #{{ $property->property_id }}</div>
                                                        <div class="text-xs opacity-80">{{ $property->full_address ?? $property->city }}</div>
                                                    </td>
                                                    <td class="px-5 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-bold">{{ $property->property_type }}</div>
                                                        <div class="text-xs opacity-80">{{ $property->num_rooms }} Rooms</div>
                                                    </td>
                                                    <td class="px-5 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-bold text-green-700 group-hover:text-green-400">₱{{ number_format($property->monthly_rent, 0) }}</div>
                                                    </td>
                                                    <td class="px-5 py-4 whitespace-nowrap">
                                                        @if($property->staff)
                                                            <div class="text-sm font-bold">{{ $property->staff->full_name }}</div>
                                                            <div class="text-xs opacity-80">{{ $property->staff->position }}</div>
                                                        @else
                                                            <span class="text-sm italic opacity-60">Unassigned</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="bg-white rounded-xl p-8 text-center border-2 border-dashed border-[#3E4E35] shadow-sm">
                                    <h3 class="text-md font-bold text-[#3E4E35]">No Properties Found</h3>
                                    <p class="mt-1 text-sm text-[#3E4E35] opacity-80">This branch is currently not managing any properties.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-[#E2DFCF] rounded-xl p-12 text-center border-2 border-dashed border-[#3E4E35] shadow-inner text-[#3E4E35]">
                        <div class="text-4xl mb-4">🏢</div>
                        <h3 class="text-xl font-bold">No Branches Registered</h3>
                        <p class="mt-2 text-md opacity-80">There are no branches currently registered in the system.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
