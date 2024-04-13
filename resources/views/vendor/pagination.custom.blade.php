@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-prev cursor-not-allowed">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-prev">&lsaquo;</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-next">&rsaquo;</a>
        @else
            <span class="pagination-next cursor-not-allowed">&rsaquo;</span>
        @endif
    </nav>
@endif
