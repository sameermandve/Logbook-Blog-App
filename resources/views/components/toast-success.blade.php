<div class="w-full flex justify-center mt-4">
    <div id="toast-success" class="flex items-center w-full max-w-sm p-4 text-gray-700 bg-emerald-50 rounded-xl shadow-md border-2 border-emerald-300" role="alert">
        <div class="inline-flex items-center justify-center shrink-0 w-7 h-7 text-green-700">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-semibold text-green-700">{{ $slot }}</div>
        <button type="button" class="ms-auto flex items-center justify-center text-gray-700 hover:text-gray-900 bg-transparent box-border border-2 border-transparent hover:bg-emerald-100 focus:ring-2 focus:ring-green-200 focus:ring-offset-2 transition ease-in-out duration-150 font-medium leading-5 rounded text-sm h-8 w-8 focus:outline-none" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
            </svg>
        </button>
    </div>
</div>