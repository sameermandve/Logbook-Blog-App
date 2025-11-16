@if ($paginator->hasPages())
<nav role="navigation" aria-label="{!! __('Pagination Navigation') !!}" class="flex justify-between">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-gray-200 text-gray-500 cursor-not-allowed leading-5 rounded-md shadow-sm">
        <x-lucide-chevrons-left class="w-4 h-4 mr-1" />
        {!! __('pagination.previous') !!}
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-transparent leading-5 rounded-md hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 active:bg-primary-700 transition ease-in-out duration-150">
        <x-lucide-chevrons-left class="w-4 h-4 mr-1" />
        {!! __('pagination.previous') !!}
    </a>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-transparent leading-5 rounded-md hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 active:bg-primary-700 transition ease-in-out duration-150">
        {!! __('pagination.next') !!}
        <x-lucide-chevrons-right class="w-4 h-4 ml-1" />
    </a>
    @else
    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-gray-200 text-gray-500 cursor-not-allowed leading-5 rounded-md shadow-sm">
        {!! __('pagination.next') !!}
        <x-lucide-chevrons-right class="w-4 h-4 ml-1" />
    </span>
    @endif
</nav>
@endif
