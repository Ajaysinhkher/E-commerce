{{-- {{ dd($paginator) }} --}}
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 mx-1 text-gray-400 bg-gray-100 border rounded-md cursor-not-allowed">
                Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 mx-1 text-gray-700 bg-white border rounded-md hover:bg-gray-100 prev-page" data-page="{{ $paginator->currentPage() - 1 }}">
                Previous
            </a>
        @endif

        {{-- Pagination Elements --}}
        
        @foreach ($paginator->links()->elements as $element)
            @if (is_string($element))
                <span class="px-4 py-2 mx-1 text-gray-500 bg-gray-100 border rounded-md">
                    {{ $element }}
                </span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 mx-1 text-white bg-blue-500 border rounded-md">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 mx-1 text-gray-700 bg-white border rounded-md hover:bg-gray-100 page-link" data-page="{{ $page }}">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 mx-1 text-gray-700 bg-white border rounded-md hover:bg-gray-100 next-page" data-page="{{ $paginator->currentPage() + 1 }}">
                Next
            </a>
        @else
            <span class="px-4 py-2 mx-1 text-gray-400 bg-gray-100 border rounded-md cursor-not-allowed">
                Next
            </span>
        @endif
    </nav>
@endif
