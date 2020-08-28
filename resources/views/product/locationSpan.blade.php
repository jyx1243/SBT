<svg class="bi m-1" width="18" height="18" fill="currentColor">
    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#box-seam"/>
</svg>
{{ $location->zone->name }}
@if ($location->layer)
    {{ $location->layer }}層
@endif

@if ($location->col)
    <svg class="bi my-1" width="18" height="18" fill="currentColor">
        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#arrow-right-circle"/>
    </svg>
    {{ $location->col }}
@endif

@if ($location->row)
    <svg class="bi my-1" width="18" height="18" fill="currentColor">
        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#arrow-down-circle"/>
    </svg>
    {{ $location->row }}
@endif