@extends('layouts.master') 
@section('title', $option->product->name . ' ' . $option->name . ' | ') 
@section('content')

<div class="container">
    <div class="rounded bg-white shadow-sm mt-4 p-3">
        <div class="d-flex flex-column flex-md-row">
            <div class="col-md-6 px-0">
                <div class="img-square">
                    <img class="img-contain" src="{{ asset('img/product/'. $option->image) }}">
                </div>
            </div>

            <div class="d-flex flex-column flex-fill ml-md-5 mt-3 mt-md-0">
                <h4><a href="{{ route('product.index') }}?category[]={{ $option->product->category->id }}" class="badge badge-secondary">
                    {{ $option->product->category->name }}
                </a></h4>
                <h4>
                    {{ $option->product->name }}
                    @if ($option->name)
                        <span class="h5">/ {{ $option->name }}</span>
                    @endif
                </h4>

                <h6 class="text-muted"> {{ $option->product->subname }}</h6>

                @if ($option->defaultPrice)
                    <div class="mt-2">
                        <small>價格：</small>
                        @include('product/Components/priceSpan', ['price' => $option->defaultPrice])
                    </div>
                @endif

                @if ($option->defaultLocation)
                    <div class="mt-2">
                        <small>位置：</small>
                        @include('product/Components/locationSpan', ['location' => $option->defaultLocation])
                    </div>
                @endif

                @if (count($option->product->options) > 1)
                    <div class="dropdown mt-3">
                        <button class="dropdown-toggle btn btn-link text-body border-top rounded-0 col pt-3" type="button" 
                        id="otherDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10">
                            其他分項 ( {{ count($option->product->options) }} )
                        </button>
                        <div class="dropdown-menu col border-0 shadow-sm" aria-labelledby="otherDropdown">
                            @foreach ($option->product->options as $otherOption)
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('product.show', $otherOption->id) }}">
                                    <img src="{{ asset('img/product/'. $otherOption->image) }}" style="width: 50px; height: 50px; object-fit: cover;">
                                    <h6 class="ml-2 mb-0">{{ $otherOption->product->name }} {{ $otherOption->name }}</h6>
                                    <span class="ml-auto">@include('product/Components/priceSpan', ['price' => $otherOption->defaultPrice])</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="d-flex flex-column flex-lg-row mt-3">
                    <a class="btn btn-outline-secondary rounded-pill mr-0 mr-lg-2 flex-fill" href="{{ route('product.edit', $option->id) }}">
                        <svg class="bi" width="18" height="18" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#pencil-square"/>
                        </svg> 修改
                    </a>
                    <button type="button" class="btn btn-outline-danger rounded-pill mt-3 mt-lg-0 flex-fill" data-toggle="modal" data-target="#destroyModal"
                    data-title="刪除 {{ $option->product->name }} {{ $option->name }}" data-action="{{ route('product.destroy', $option->id) }}">
                        <svg class="bi" width="18" height="18" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#trash"/>
                        </svg> 刪除
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column flex-md-row">
        <a id="price" class="hashtag"></a>
        <div class="rounded bg-white shadow-sm mt-4 p-3 col mr-0 mr-md-4">
            <h5 class="mb-3">
                <svg class="bi" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#tag"/>
                </svg> 價格
            </h5>
            @foreach ($option->prices->sortBy('unit_id')->values() as $price)
                <div class="border-top pt-2 mt-2">
                    @include('product/Components/priceSpan', ['price' => $price])

                    @foreach ($price->sales as $sale)
                        <span class="badge badge-secondary ml-1 align-baseline">
                            <span class="h6">
                                優惠 ${{ $sale->value }} / {{ $sale->quantity }}{{ $price->unit->name }}
                            </span>                             
                        </span>
                    @endforeach
                </div>
            @endforeach
        </div>

        <a id="location" class="hashtag"></a>
        <div class="rounded bg-white shadow-sm mt-4 p-3 col">
            <h5 class="mb-3">
                <svg class="bi" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#box-seam"/>
                </svg> 位置
            </h5>
            @foreach ($option->locations as $location)
                <div class="border-top pt-2 mt-2">
                    @include('product/Components/locationSpan', ['location' => $location])
                </div>
            @endforeach
        </div>
    </div>

    @if ($option->ingredient)
        <a id="" class="hashtag"></a>
        <div class="rounded bg-white shadow-sm mt-4 p-3">
            <h5 class="mb-3">
                <svg class="bi" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#journal"/>
                </svg> 配方
                <small class="text-muted"> | 總計 {{ count($option->ingredient->options) }}</small>
            </h5>
            <h6>說明：{{ $option->ingredient->description }}</h6>

            <div class="d-flex flex-wrap mx-n3">
                @foreach ($option->ingredient->options as $ingredientOption)
                    <div class="col-12 col-sm-6 col-lg-4 d-flex justify-content-between mt-2">
                        <a class="h5 text-body" href="{{ route('product.show', $ingredientOption->id) }}">
                            {{ $ingredientOption->product->name }}
                            @if ($ingredientOption->name)
                                <span class="small"> / {{ $ingredientOption->name }}</span>
                            @endif
                        </a>
                        <h5>
                            {{ $ingredientOption->pivot->quantity.' '.App\Models\Unit::find($ingredientOption->pivot->unit_id)->name }}
                        </h5>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if (count($option->product->options) > 1)
        <div class="rounded bg-white shadow-sm mt-4 p-3">
            <h5>
                <svg class="bi" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#diagram-3"/>
                </svg> 其他分項
                <small class="text-muted"> | 總計 {{ count($option->product->options) }}</small>
            </h5>
            <div class="d-flex flex-wrap mx-n3">
                @foreach ($option->product->options as $otherOption)
                    <div class="col-6 col-md-4 col-lg-3 mt-3">
                        @include('product/Components/productCard', ['option' => $otherOption])
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@include('components/destroyModal')

@endsection