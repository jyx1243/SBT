<a href="{{ route('product.show', $option->id) }}">
    <div class="img-square">
        <img class="img-cover" src="{{ asset('img/product/'. $option->image) }}">
    </div>

    <h5 class="text-body mt-3">
        {{ $option->product->name }}
        @if($option->name)
            <span class="h6">/ {{ $option->name }}</span>
        @endif
    </h5>
</a>
@if ($option->defaultPrice)
    <div class="">
        @include('product/Components/priceSpan', ['price' => $option->defaultPrice])
    </div>
@endif
@if ($option->defaultLocation)
    <div class="d-inline-block p-1 pr-2 rounded shadow-sm mt-1 small">
        @include('product/Components/locationSpan', ['location' => $option->defaultLocation])
    </div>
@endif