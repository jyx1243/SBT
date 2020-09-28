<svg class="bi mx-1 mb-1" width="16" height="16" fill="currentColor">
    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#box-seam"/>
</svg>
{{ $location->zone->name }}
@if ($location->layer)
    {{ $location->layer }}層
@endif

@if ($location->col)
    <svg class="bi mb-1" width="16" height="16" fill="currentColor">
        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#arrow-right-circle"/>
    </svg>
    {{ $location->col }}
@endif

@if ($location->row)
    <svg class="bi mb-1" width="16" height="16" fill="currentColor">
        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#arrow-down-circle"/>
    </svg>
    {{ $location->row }}
@endif