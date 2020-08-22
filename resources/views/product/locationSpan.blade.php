<span class="bg-white p-1 pr-2 rounded shadow-sm">
    <svg class="bi m-1" width="18" height="18" fill="currentColor">
        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#box-seam"/>
    </svg>
    {{ $option->defaultLocation->zone->name }}
    @if($option->defaultLocation->layer !== null)
        {{ $option->defaultLocation->layer }}層
    @endif

    @if($option->defaultLocation->col !== null)
        <svg class="bi my-1" width="18" height="18" fill="currentColor">
            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#arrow-right-circle"/>
        </svg>
        {{ $option->defaultLocation->col }}
    @endif

    @if($option->defaultLocation->col !== null)
        <svg class="bi my-1" width="18" height="18" fill="currentColor">
            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#arrow-down-circle"/>
        </svg>
        {{ $option->defaultLocation->row }}
    @endif
</span>