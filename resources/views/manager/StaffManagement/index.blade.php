<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#3E4E35] leading-tight text-center">
            {{ __('Staff Management') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ tab: 'view_staff' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Centered Tab Navigation --}}
            <div class="flex justify-center border-b border-[#3E4E35] mb-6 space-x-2">
                <button class="px-8 py-3 text-sm font-bold uppercase tracking-wider rounded-t-xl transition-all duration-200 focus:outline-none" 
                    :class="{ 'bg-[#3E4E35] text-[#DFDCCD] border-t border-l border-r border-[#3E4E35]': tab === 'view_staff', 'bg-[#DFDCCD] text-[#3E4E35] border border-transparent opacity-70 hover:opacity-100': tab !== 'view_staff' }" 
                    @click="tab = 'view_staff'">
                    View Staff
                </button>
                <button class="px-8 py-3 text-sm font-bold uppercase tracking-wider rounded-t-xl transition-all duration-200 focus:outline-none" 
                    :class="{ 'bg-[#3E4E35] text-[#DFDCCD] border-t border-l border-r border-[#3E4E35]': tab === 'team_assignment', 'bg-[#DFDCCD] text-[#3E4E35] border border-transparent opacity-70 hover:opacity-100': tab !== 'team_assignment' }" 
                    @click="tab = 'team_assignment'">
                    Team Assignment
                </button>
                <button class="px-8 py-3 text-sm font-bold uppercase tracking-wider rounded-t-xl transition-all duration-200 focus:outline-none" 
                    :class="{ 'bg-[#3E4E35] text-[#DFDCCD] border-t border-l border-r border-[#3E4E35]': tab === 'record_of_nextofkin', 'bg-[#DFDCCD] text-[#3E4E35] border border-transparent opacity-70 hover:opacity-100': tab !== 'record_of_nextofkin' }" 
                    @click="tab = 'record_of_nextofkin'">
                    Record of Next of Kin
                </button>
            </div>

            <div class="bg-[#DFDCCD] overflow-hidden shadow-lg sm:rounded-lg border border-[#3E4E35]">
                <div class="p-6">
                    
                    {{-- View Staff Tab Content --}}
                    <div x-show="tab === 'view_staff'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                        <div class="flex justify-between items-center mb-6">
                            <p class="text-[#3E4E35] font-bold text-xl">Active Staff Roster</p>
                            <button class="bg-[#3E4E35] text-[#DFDCCD] font-bold py-2 px-6 rounded shadow transition hover:opacity-90">
                                + Register Staff
                            </button>
                        </div>
                        
                        @if($staffList->count() > 0)
                            <div class="overflow-x-auto bg-[#DFDCCD] rounded-xl shadow-inner border border-[#3E4E35]">
                                <table class="min-w-full divide-y divide-[#3E4E35]">
                                    <thead class="bg-[#3E4E35]">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">ID</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Staff Name</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Position</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Salary</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Date Started</th>
                                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-[#DFDCCD] divide-y divide-[#3E4E35]">
                                        @foreach($staffList as $staff)
                                            <tr class="hover:bg-[#3E4E35] hover:text-[#DFDCCD] transition group text-[#3E4E35]">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm opacity-80">#{{ $staff->staff_id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-bold">{{ $staff->full_name }}</div>
                                                    <div class="text-xs opacity-70">{{ $staff->telephone ?? 'No Phone' }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-[#3E4E35] text-[#DFDCCD] group-hover:bg-[#DFDCCD] group-hover:text-[#3E4E35] border border-[#3E4E35] group-hover:border-[#DFDCCD]">
                                                        {{ $staff->position }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold">
                                                    £{{ number_format($staff->salary, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm opacity-80">
                                                    {{ $staff->date_started ? \Carbon\Carbon::parse($staff->date_started)->format('d M Y') : 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold space-x-3">
                                                    <a href="#" class="opacity-80 hover:opacity-100 hover:underline">Edit</a>
                                                    <a href="#" class="opacity-80 hover:opacity-100 hover:underline">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-[#DFDCCD] rounded-xl p-12 text-center border-2 border-dashed border-[#3E4E35] shadow-inner text-[#3E4E35]">
                                <h3 class="text-lg font-bold">No Staff Records Found</h3>
                                <p class="mt-1 text-sm opacity-80">The staff list for your branch is currently empty.</p>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Team Assignment Tab Content --}}
                    <div x-show="tab === 'team_assignment'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" style="display: none;">
                        <div class="flex justify-between items-center mb-6">
                            <p class="text-[#3E4E35] font-bold text-xl">Team Assignment</p>
                        </div>
                        
                        @if($staffList->count() > 0)
                            <div class="overflow-x-auto bg-[#DFDCCD] rounded-xl shadow-inner border border-[#3E4E35]">
                                <table class="min-w-full divide-y divide-[#3E4E35]">
                                    <thead class="bg-[#3E4E35]">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">ID</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Staff Name</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Position</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Current Supervisor</th>
                                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-[#DFDCCD] divide-y divide-[#3E4E35]">
                                        @foreach($staffList as $staff)
                                            <tr class="hover:bg-[#3E4E35] hover:text-[#DFDCCD] transition group text-[#3E4E35]">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm opacity-80">#{{ $staff->staff_id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-bold">{{ $staff->full_name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm opacity-80">
                                                    {{ $staff->position }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($staff->supervisor)
                                                        <div class="text-sm font-bold">{{ $staff->supervisor->full_name }}</div>
                                                        <div class="text-xs opacity-70">{{ $staff->supervisor->position }}</div>
                                                    @else
                                                        <span class="text-sm italic opacity-50">Unassigned</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold space-x-3">
                                                    <button class="bg-[#3E4E35] text-[#DFDCCD] font-bold py-1 px-4 rounded shadow transition group-hover:bg-[#DFDCCD] group-hover:text-[#3E4E35] border border-[#DFDCCD] group-hover:border-[#3E4E35]">
                                                        Update Assignment
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-[#DFDCCD] rounded-xl p-12 text-center border-2 border-dashed border-[#3E4E35] shadow-inner text-[#3E4E35]">
                                <div class="text-4xl mb-4">🛡️</div>
                                <h3 class="text-lg font-bold">No Staff Found</h3>
                                <p class="mt-1 text-sm opacity-80">There are no staff records available for team assignment.</p>
                            </div>
                        @endif
                    </div>

                    {{-- Record of Next of Kin Tab Content --}}
                    <div x-show="tab === 'record_of_nextofkin'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" style="display: none;">
                        <div class="flex justify-between items-center mb-6">
                            <p class="text-[#3E4E35] font-bold text-xl">Record of Next of Kin</p>
                            <button class="bg-[#3E4E35] text-[#DFDCCD] font-bold py-2 px-6 rounded shadow transition hover:opacity-90">
                                + Add Next of Kin
                            </button>
                        </div>
                        @if($staffList->count() > 0)
                            <div class="overflow-x-auto bg-[#DFDCCD] rounded-xl shadow-inner border border-[#3E4E35]">
                                <table class="min-w-full divide-y divide-[#3E4E35]">
                                    <thead class="bg-[#3E4E35]">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Staff Name</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Next of Kin Name</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Relationship</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Contact</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-[#DFDCCD] divide-y divide-[#3E4E35]">
                                        @foreach($staffList as $staff)
                                            @if($staff->nextOfKin->isNotEmpty())
                                                @foreach($staff->nextOfKin as $kin)
                                                    <tr class="hover:bg-[#3E4E35] hover:text-[#DFDCCD] transition group text-[#3E4E35]">
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm font-bold">{{ $staff->full_name }}</div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm font-bold">{{ $kin->name }}</div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm opacity-80">{{ $kin->relationship }}</div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm opacity-80">{{ $kin->telephone }}</div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="bg-[#DFDCCD] text-[#3E4E35]">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-bold">{{ $staff->full_name }}</div>
                                                    </td>
                                                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm opacity-80 text-center italic">
                                                        No next of kin record found.
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-[#DFDCCD] rounded-xl p-12 text-center border-2 border-dashed border-[#3E4E35] shadow-inner text-[#3E4E35]">
                                <h3 class="text-lg font-bold">No Staff Records Found</h3>
                                <p class="mt-1 text-sm opacity-80">The staff list for your branch is currently empty.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>