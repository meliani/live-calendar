{{-- Modal By meliani --}}
<div x-data="{ showModal: @entangle('showModal') }">
    <!-- Add/Edit Event Modal -->
    <div class="fixed z-10 inset-0 overflow-y-auto" x-show="showModal">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal Content -->
            <div class="fixed z-10 inset-0 overflow-y-auto" x-show="showModal">
                <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" x-show="showModal"
                        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;

                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                        x-show="showModal" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h2 class="text-lg leading-6 font-medium text-gray-900">Edit Event</h2>
                            <form wire:submit.prevent="updateEvent">
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
                                    <input
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        id="title" type="text" wire:model.defer="editedEvent.title">
                                    @error('editedEvent.title')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700" for="starting_at">Start
                                        Date</label>
                                    <input
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        id="starting_at" type="date" wire:model.defer="editedEvent.starting_at">
                                    @error('editedEvent.starting_at')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700" for="ending_at">End
                                        Date</label>
                                    <input
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        id="ending_at" type="date" wire:model.defer="editedEvent.ending_at">
                                    @error('editedEvent.ending_at')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <button
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        type="submit">
                                        Save
                                    </button>
                                    <button
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 ml-2"
                                        type="button" wire:click="cancelEditing">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End of modal --}}
