{{-- Next of Kin Add/Update Modal --}}
<div x-show="isNextOfKinModalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="isNextOfKinModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="isNextOfKinModalOpen = false" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div x-show="isNextOfKinModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-[#DFDCCD] rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border-2 border-[#3E4E35]">
            
            <form action="{{ route('manager.StaffManagement.nextofkin') }}" method="POST">
                @csrf
                <input type="hidden" name="next_of_kin_id" x-model="activeKinId">
                
                <div class="bg-[#DFDCCD] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-xl leading-6 font-bold text-[#3E4E35] border-b border-[#3E4E35] pb-3 mb-5" id="modal-title" x-text="activeKinId ? 'Update Next of Kin' : 'Register Next of Kin'"></h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Staff Assignment -->
                                <div class="md:col-span-2">
                                    <label for="staff_id" class="block text-sm font-bold text-[#3E4E35]">Assign to Staff Member <span class="text-red-600">*</span></label>
                                    <select id="staff_id" name="staff_id" x-model="activeKinStaffId" required class="mt-1 block w-full py-2 px-3 border border-[#3E4E35] bg-white rounded-md shadow-sm focus:outline-none focus:ring-[#3E4E35] focus:border-[#3E4E35] sm:text-sm text-[#3E4E35]">
                                        <option value="">Select a Staff Member</option>
                                        @foreach($staffList as $staff)
                                            <option value="{{ $staff->staff_id }}">{{ $staff->full_name }} ({{ $staff->position }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Name -->
                                <div>
                                    <label for="kin_name" class="block text-sm font-bold text-[#3E4E35]">Next of Kin Name <span class="text-red-600">*</span></label>
                                    <input type="text" name="name" id="kin_name" x-model="activeKinName" required class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                </div>

                                <!-- Relationship -->
                                <div>
                                    <label for="kin_relationship" class="block text-sm font-bold text-[#3E4E35]">Relationship <span class="text-red-600">*</span></label>
                                    <input type="text" name="relationship" id="kin_relationship" x-model="activeKinRelationship" required class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                </div>

                                <!-- Telephone -->
                                <div>
                                    <label for="kin_telephone" class="block text-sm font-bold text-[#3E4E35]">Telephone <span class="text-red-600">*</span></label>
                                    <input type="text" name="telephone" id="kin_telephone" x-model="activeKinTelephone" required class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                </div>

                                <!-- Address -->
                                <div class="md:col-span-2">
                                    <label for="kin_address" class="block text-sm font-bold text-[#3E4E35]">Full Address</label>
                                    <input type="text" name="address" id="kin_address" x-model="activeKinAddress" class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-[#DFDCCD] px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse border-t border-[#3E4E35]">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-2 bg-[#3E4E35] text-base font-bold text-[#DFDCCD] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3E4E35] sm:ml-3 sm:w-auto sm:text-sm transition" x-text="activeKinId ? 'Save Changes' : 'Add Next of Kin'"></button>
                    <button type="button" @click="isNextOfKinModalOpen = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-[#3E4E35] shadow-sm px-6 py-2 bg-[#DFDCCD] text-base font-bold text-[#3E4E35] hover:bg-[#3E4E35] hover:text-[#DFDCCD] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3E4E35] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
