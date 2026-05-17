{{-- Assign Staff Modal --}}
<div x-show="isAssignModalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div x-show="isAssignModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="isAssignModalOpen = false" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal panel -->
        <div x-show="isAssignModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-[#DFDCCD] rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border-2 border-[#3E4E35]">
            
            <form id="assign-form" method="POST" x-data="{ checkedCount: 0 }" x-init="$watch('isAssignModalOpen', value => { if(value) checkedCount = document.querySelectorAll('#assign-form input[type=\'checkbox\']:checked').length })">
                @csrf
                <div class="bg-[#DFDCCD] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-xl leading-6 font-bold text-[#3E4E35] border-b border-[#3E4E35] pb-3 mb-5" id="modal-title">
                                Assign Team for <span x-text="activeSupervisorName" class="underline"></span>
                            </h3>
                            
                            <p class="text-sm font-bold text-[#3E4E35] mb-4">Case Study Requirement: Select between 5 and 10 staff members.</p>

                            <div class="max-h-64 overflow-y-auto border border-[#3E4E35] rounded bg-white p-3">
                                @if($assignableStaff->count() > 0)
                                    @foreach($assignableStaff as $as)
                                        <div class="flex items-center mb-2 p-2 hover:bg-gray-100 rounded">
                                            <input type="checkbox" name="staff_ids[]" value="{{ $as->staff_id }}" 
                                                   id="staff_{{ $as->staff_id }}" 
                                                   class="h-4 w-4 text-[#3E4E35] focus:ring-[#3E4E35] border-gray-300 rounded"
                                                   x-bind:checked="activeSupervisorId == {{ $as->supervisor_id ?? 'null' }}"
                                                   @change="checkedCount = document.querySelectorAll('#assign-form input[type=\'checkbox\']:checked').length">
                                            <label for="staff_{{ $as->staff_id }}" class="ml-3 block text-sm font-bold text-[#3E4E35]">
                                                {{ $as->full_name }} <span class="opacity-70 text-xs">({{ $as->position }})</span>
                                            </label>
                                            @if($as->supervisor_id)
                                                <span class="ml-auto text-xs italic text-gray-500">
                                                    (Sup: #{{ $as->supervisor_id }})
                                                </span>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-sm text-center italic opacity-70">No assignable staff found.</p>
                                @endif
                            </div>
                            <p class="mt-2 text-sm text-[#3E4E35] font-bold">Currently selected: <span x-text="checkedCount" :class="{'text-red-500': checkedCount < 5 || checkedCount > 10, 'text-green-600': checkedCount >= 5 && checkedCount <= 10}"></span> / 10</p>
                        </div>
                    </div>
                </div>
                <div class="bg-[#DFDCCD] px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse border-t border-[#3E4E35]">
                    <button type="submit" 
                            :disabled="checkedCount < 5 || checkedCount > 10"
                            :class="{'opacity-50 cursor-not-allowed': checkedCount < 5 || checkedCount > 10}"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-2 bg-[#3E4E35] text-base font-bold text-[#DFDCCD] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3E4E35] sm:ml-3 sm:w-auto sm:text-sm transition">
                        Save Team
                    </button>
                    <button type="button" @click="isAssignModalOpen = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-[#3E4E35] shadow-sm px-6 py-2 bg-[#DFDCCD] text-base font-bold text-[#3E4E35] hover:bg-[#3E4E35] hover:text-[#DFDCCD] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3E4E35] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
