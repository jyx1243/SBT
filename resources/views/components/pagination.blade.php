<nav aria-label="Page navigation">
    <ul class="pagination justify-content-end my-3 p-0">
        @if ($results->currentPage() > 1)
            <li class="page-item">
                <a class="page-link bg-transparent border-0 text-body ml-2" href="{{ $results->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            @if ($results->currentPage() > 2)
                <li class="page-item">
                    <a class="page-link border-0 shadow-sm rounded text-body ml-2" href="{{ $results->url(1) }}">
                        1
                    </a>
                </li>
                
                @if ($results->currentPage() > 3)
                    <li class="page-item ml-2">...</li>
                @endif
            @endif

            <li class="page-item">
                <a class="page-link border-0 shadow-sm rounded text-body ml-2" href="{{ $results->previousPageUrl() }}">
                    {{ $results->currentPage()-1 }}
                </a>
            </li>
        @endif
        
        <li class="page-item disabled">
            <a class="page-link border-0 rounded text-body font-weight-bold ml-2 bg-transparent">
                {{ $results->currentPage() }}
            </a>
        </li>
        
        @if ($results->hasMorePages())
            <li class="page-item">
                <a class="page-link border-0 shadow-sm rounded text-body ml-2" href="{{ $results->nextPageUrl() }}">
                    {{ $results->currentPage()+1 }}
                </a>
            </li>

            @if ($results->lastPage()-$results->currentPage() > 2)
                <li class="page-item ml-2">...</li>
            @endif

            @if ($results->lastPage()-$results->currentPage() > 1)
                <li class="page-item">
                    <a class="page-link border-0 shadow-sm rounded text-body ml-2" href="{{ $results->url($results->lastPage()) }}">
                        {{ $results->lastPage() }}
                    </a>
                </li>
            @endif

            <li class="page-item">
                <a class="page-link bg-transparent border-0 text-body ml-2" href="{{ $results->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        @endif
    </ul>
</nav>