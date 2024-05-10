<div class="fixed top-0 right-0 overflow-hidden m-14 p-4 pt-6 border-2 border-green-500 font-bold bg-white z-10" id="{{ $id }}" aria-labelledby="{{ $id }}Label" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center text-center sm:block">
        <div class="absolute top-0 right-0 pt-2 pr-2">
            <button type="button" class="btn-close text-gray-500 hover:text-gray-700" data-dismiss="modal" aria-label="Close">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="sm:flex sm:items-start">
            <div class="w-full mt-3 text-center sm:mt-0 sm:text-left">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>