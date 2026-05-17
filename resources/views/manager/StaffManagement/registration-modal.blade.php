{{-- Register Staff Modal --}}
<div x-show="isRegisterModalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div x-show="isRegisterModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="isRegisterModalOpen = false" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal panel -->
        <div x-show="isRegisterModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-[#DFDCCD] rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border-2 border-[#3E4E35]">
            
            <form action="{{ route('manager.StaffManagement.store') }}" method="POST">
                @csrf
                <div class="bg-[#DFDCCD] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-xl leading-6 font-bold text-[#3E4E35] border-b border-[#3E4E35] pb-3 mb-5" id="modal-title">
                                Staff Registration Form 
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-bold text-[#3E4E35]">First Name <span class="text-red-600">*</span></label>
                                    <input type="text" name="name" id="name" required class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                </div>
                                <div>
                                    <label for="surname" class="block text-sm font-bold text-[#3E4E35]">Last Name <span class="text-red-600">*</span></label>
                                    <input type="text" name="surname" id="surname" required class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                </div>

                                <!-- Personal Info -->
                                <div>
                                    <label for="gender" class="block text-sm font-bold text-[#3E4E35]">Gender <span class="text-red-600">*</span></label>
                                    <select id="gender" name="gender" required class="mt-1 block w-full py-2 px-3 border border-[#3E4E35] bg-white rounded-md shadow-sm focus:outline-none focus:ring-[#3E4E35] focus:border-[#3E4E35] sm:text-sm text-[#3E4E35]">
                                        <option value="">Select Gender</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="date_of_birth" class="block text-sm font-bold text-[#3E4E35]">Date of Birth <span class="text-red-600">*</span></label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" required class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                </div>

                                <!-- NIN & Phone -->
                                <div>
                                    <label for="nin" class="block text-sm font-bold text-[#3E4E35]">National Insurance Number (NIN) <span class="text-red-600">*</span></label>
                                    <input type="text" name="nin" id="nin" required class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                </div>
                                <!-- Contact Info -->
                                <div>
                                    <label for="telephone" class="block text-sm font-bold text-[#3E4E35]">Telephone</label>
                                    <input type="text" name="telephone" id="telephone" class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-bold text-[#3E4E35]">Email Address (For Login) <span class="text-red-600">*</span></label>
                                    <input type="email" name="email" id="email" required class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                </div>

                                <!-- Address -->
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-bold text-[#3E4E35]">Full Address</label>
                                    <input type="text" name="address" id="address" class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                </div>

                                <!-- Position & Salary -->
                                <div>
                                    <label for="position" class="block text-sm font-bold text-[#3E4E35]">Position <span class="text-red-600">*</span></label>
                                    <select id="position" name="position" required class="mt-1 block w-full py-2 px-3 border border-[#3E4E35] bg-white rounded-md shadow-sm focus:outline-none focus:ring-[#3E4E35] focus:border-[#3E4E35] sm:text-sm text-[#3E4E35]">
                                        <option value="">Select Position</option>
                                        <option value="Regular staff">Regular Staff</option>
                                        <option value="Secretary">Secretary</option>
                                        <option value="Supervisor">Supervisor</option>
                                    </select>
                                    <p class="mt-1 text-xs text-[#3E4E35] opacity-80 font-bold">Note: Managers cannot register new Managers.</p>
                                </div>
                                <div>
                                    <label for="salary" class="block text-sm font-bold text-[#3E4E35]">Annual Salary (₱) <span class="text-red-600">*</span></label>
                                    <input type="number" step="0.01" name="salary" id="salary" required class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                </div>

                                <!-- Date Started -->
                                <div>
                                    <label for="date_started" class="block text-sm font-bold text-[#3E4E35]">Date Started <span class="text-red-600">*</span></label>
                                    <input type="date" name="date_started" id="date_started" required class="mt-1 focus:ring-[#3E4E35] focus:border-[#3E4E35] block w-full shadow-sm sm:text-sm border-[#3E4E35] rounded-md bg-white text-[#3E4E35]">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-[#DFDCCD] px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse border-t border-[#3E4E35]">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-2 bg-[#3E4E35] text-base font-bold text-[#DFDCCD] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3E4E35] sm:ml-3 sm:w-auto sm:text-sm transition">
                        Submit Registration
                    </button>
                    <button type="button" @click="isRegisterModalOpen = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-[#3E4E35] shadow-sm px-6 py-2 bg-[#DFDCCD] text-base font-bold text-[#3E4E35] hover:bg-[#3E4E35] hover:text-[#DFDCCD] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3E4E35] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
