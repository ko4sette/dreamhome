<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-[#3E4E35] leading-tight">
                {{ __('Staff Management') }}
            </h2>
            <button class="bg-[#3E4E35] hover:bg-opacity-90 text-white font-bold py-2 px-4 rounded shadow transition">
                + Add New Staff
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#E2DFCF] overflow-hidden shadow-lg sm:rounded-lg border border-[#DFDCCD]">
                <div class="p-6">
                    <p class="text-[#3E4E35] font-bold text-xl mb-4">Active Staff Roster</p>
                    
                    <!-- Staff Data Table -->
                    @if($staffList->count() > 0)
                        <div class="overflow-x-auto bg-white rounded-xl shadow-inner border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-[#E2DFCF]">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#3E4E35] uppercase tracking-wider">ID</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#3E4E35] uppercase tracking-wider">Staff Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#3E4E35] uppercase tracking-wider">Position</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#3E4E35] uppercase tracking-wider">Branch</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#3E4E35] uppercase tracking-wider">Supervisor</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-[#3E4E35] uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($staffList as $staff)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                #{{ $staff->staff_id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $staff->full_name }}</div>
                                                <div class="text-xs text-gray-500">{{ $staff->telephone ?? 'No Phone' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $staff->position }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $staff->branch->city ?? 'N/A' }} ({{ $staff->branch->street ?? 'N/A' }})
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($staff->supervisor)
                                                    <div class="text-sm text-gray-900">{{ $staff->supervisor->full_name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $staff->supervisor->position }}</div>
                                                @else
                                                    <span class="text-sm text-gray-400 italic">None</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="#" class="text-[#3E4E35] hover:text-green-700 font-bold mr-3">Edit</a>
                                                <a href="#" class="text-red-600 hover:text-red-900 font-bold">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="bg-white rounded-xl p-12 text-center border-2 border-dashed border-gray-300 shadow-inner">
                            <div class="text-4xl mb-4">👥</div>
                            <h3 class="text-lg font-medium text-gray-900">No Staff Records Found</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                The staff list for your branch is currently empty.
                            </p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
