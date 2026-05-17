<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#3E4E35] leading-tight">
            {{ __('Staff Financial Records') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ isFinancialModalOpen: false, activeStaffId: null, activeStaffName: '', activeSalary: '', activeCarAllowance: '', activeBonus: '', activePosition: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-[#E2DFCF] overflow-hidden shadow-lg sm:rounded-lg border border-[#DFDCCD]">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-[#3E4E35] font-bold text-xl">Branch Staff Financials</p>
                    </div>

                    @if($staffList->count() > 0)
                        <div class="overflow-x-auto bg-[#DFDCCD] rounded-xl shadow-inner border border-[#3E4E35]">
                            <table class="min-w-full divide-y divide-[#3E4E35]">
                                <thead class="bg-[#3E4E35]">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Staff Member</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Position</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Base Salary</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Car Allowance</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Monthly Bonus</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-[#DFDCCD] uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-[#DFDCCD] divide-y divide-[#3E4E35]">
                                    @foreach($staffList as $staff)
                                        <tr class="hover:bg-[#3E4E35] hover:text-[#DFDCCD] transition group text-[#3E4E35]">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold">{{ $staff->full_name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm opacity-80">{{ $staff->position }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-green-700 group-hover:text-green-400">₱{{ number_format($staff->salary, 2) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm opacity-80">
                                                    @if($staff->car_allowance)
                                                        ₱{{ number_format($staff->car_allowance, 2) }}
                                                    @else
                                                        <span class="text-gray-500 italic">N/A</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm opacity-80">
                                                    @if($staff->bonus)
                                                        ₱{{ number_format($staff->bonus, 2) }}
                                                    @else
                                                        <span class="text-gray-500 italic">N/A</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold">
                                                <button @click="isFinancialModalOpen = true; activeStaffId = '{{ $staff->staff_id }}'; activeStaffName = '{{ addslashes($staff->full_name) }}'; activePosition = '{{ $staff->position }}'; activeSalary = '{{ $staff->salary }}'; activeCarAllowance = '{{ $staff->car_allowance ?? '' }}'; activeBonus = '{{ $staff->bonus ?? '' }}'" class="bg-[#3E4E35] text-[#DFDCCD] font-bold py-1 px-4 rounded shadow transition group-hover:bg-[#DFDCCD] group-hover:text-[#3E4E35] border border-[#DFDCCD] group-hover:border-[#3E4E35]">
                                                    Manage Financials
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-[#DFDCCD] rounded-xl p-12 text-center border-2 border-dashed border-[#3E4E35] shadow-inner text-[#3E4E35]">
                            <h3 class="text-lg font-bold">No Staff Records Found</h3>
                            <p class="mt-1 text-sm opacity-80">You do not have any staff members registered to your branch yet.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- Financial Update Modal --}}
        <div x-show="isFinancialModalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="isFinancialModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="isFinancialModalOpen = false" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="isFinancialModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-[#DFDCCD] rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full border-2 border-[#3E4E35]">
                    
                    <form action="{{ route('manager.StaffReport.financials') }}" method="POST">
                        @csrf
                        <input type="hidden" name="staff_id" x-model="activeStaffId">
                        
                        <div class="bg-[#DFDCCD] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-xl leading-6 font-bold text-[#3E4E35] border-b border-[#3E4E35] pb-3 mb-5" id="modal-title">
                                        Update Financials: <span x-text="activeStaffName"></span>
                                    </h3>
                                    
                                    <div class="space-y-5">
                                        <!-- Base Salary -->
                                        <div>
                                            <label for="salary" class="block text-sm font-bold text-[#3E4E35]">Annual Salary (₱) <span class="text-red-600">*</span></label>
                                            <input type="number" step="0.01" name="salary" id="salary" x-model="activeSalary" required class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                        </div>

                                        <!-- Car Allowance & Bonus (Only show context hint if they are not a manager, although managers can assign to anyone if they want, but usually it's for managers) -->
                                        <div x-show="activePosition === 'Manager' || activePosition === 'Supervisor' || true" class="space-y-5 p-4 border border-[#3E4E35] rounded-lg bg-[#E2DFCF]">
                                            <p class="text-xs font-bold text-[#3E4E35] uppercase mb-2">Performance & Allowances</p>
                                            
                                            <!-- Car Allowance -->
                                            <div>
                                                <label for="car_allowance" class="block text-sm font-bold text-[#3E4E35]">Annual Car Allowance (₱)</label>
                                                <input type="number" step="0.01" name="car_allowance" id="car_allowance" x-model="activeCarAllowance" class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                                <p class="mt-1 text-xs text-gray-600">Case Study: Each manager is allocated an annual car allowance.</p>
                                            </div>

                                            <!-- Monthly Bonus -->
                                            <div>
                                                <label for="bonus" class="block text-sm font-bold text-[#3E4E35]">Monthly Bonus (₱)</label>
                                                <input type="number" step="0.01" name="bonus" id="bonus" x-model="activeBonus" class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                                <p class="mt-1 text-xs text-gray-600">Based upon performance in the property for rent market.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-[#DFDCCD] px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse border-t border-[#3E4E35]">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-2 bg-[#3E4E35] text-base font-bold text-[#DFDCCD] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3E4E35] sm:ml-3 sm:w-auto sm:text-sm transition">
                                Save Financials
                            </button>
                            <button type="button" @click="isFinancialModalOpen = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-[#3E4E35] shadow-sm px-6 py-2 bg-[#DFDCCD] text-base font-bold text-[#3E4E35] hover:bg-[#3E4E35] hover:text-[#DFDCCD] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3E4E35] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
