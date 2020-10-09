<a href="{{ route('product.show', $option->id) }}" class="text-decoration-none">
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
    <a href="{{ route('product.show', $option->id) }}#price" class="text-body text-decoration-none">
        @include('product/Components/priceSpan', ['price' => $option->defaultPrice])
    </a>
@endif
@if ($option->defaultLocation)
    <a href="{{ route('product.show', $option->id) }}#location" class="btn btn-light bg-white shadow-sm btn-sm mt-1">
        @include('product/Components/locationSpan', ['location' => $option->defaultLocation])
    </a>
@endif