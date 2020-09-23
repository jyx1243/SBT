@extends('layouts.master') 
@section('title', $option->product->name . ' ' . $option->name . ' | ') 
@section('content')

<div class="container">
    <div class="rounded bg-white shadow-sm mt-4 mx-n3 p-3">
        <div class="d-flex flex-column flex-md-row">
            <div class="d-none d-md-flex justify-content-center align-items-center bg-white" style="width: 300px; min-width: 300px; height: 300px;">
                <img class="mw-100 mh-100" src="{{ asset('img/product/'. $option->image) }}">
            </div>
            <div class="d-flex d-md-none justify-content-center align-items-center bg-white" style="max-width: 100%; height: 300px;">
                <img class="mw-100 mh-100" src="{{ asset('img/product/'. $option->image) }}">
            </div>

            <div class="d-flex flex-column flex-fill ml-md-3 mt-3 mt-md-0">
                <h4><span class="badge badge-secondary">{{ $option->product->category->name }}</span></h4>
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
                        @include('product/priceSpan', ['price' => $option->defaultPrice])
                    </div>
                @endif

                @if ($option->defaultLocation)
                    <div class="mt-2">
                        <small>位置：</small>
                        @include('product/locationSpan', ['location' => $option->defaultLocation])
                    </div>
                @endif

                @if (count($option->product->options) > 1)
                    <div class="dropdown mt-3">
                        <button class="dropdown-toggle btn btn-link text-body border-top rounded-0 col pt-3" type="button" 
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10">
                            其他子項目
                        </button>
                        <div class="dropdown-menu col" aria-labelledby="dropdownMenuButton">
                            @foreach ($option->product->options as $otherOption)
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('product.show', $otherOption->id) }}">
                                    <div class="d-flex justify-content-center align-items-center bg-white" style="width: 50px; min-width: 50px; height: 50px;">
                                        <img class="mw-100 mh-100" src="{{ asset('img/product/'. $otherOption->image) }}">
                                    </div>
                                    <h6 class="ml-2">{{ $otherOption->product->name }} {{ $otherOption->name }}</h6>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="d-flex flex-column flex-lg-row mt-3">
                    <a class="btn btn-outline-secondary rounded-pill mr-0 mr-lg-2 col" href="{{ route('product.edit', $option->id) }}">
                        <svg class="bi" width="18" height="18" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#pencil-square"/>
                        </svg> 修改
                    </a>
                    <button type="button" class="btn btn-outline-danger rounded-pill mt-3 mt-lg-0 col" data-toggle="modal" data-target="#destroyModal"
                    data-title="刪除 {{ $option->product->name }} {{ $option->name }}" data-action="{{ route('product.destroy', $option->id) }}">
                        <svg class="bi" width="18" height="18" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#trash"/>
                        </svg> 刪除
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column flex-md-row mx-n3">
        <div class="rounded bg-white shadow-sm mt-3 p-3 col mr-0 mr-md-3">
            <h5 class="mb-3">
                <svg class="bi mx-2" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#tag"/>
                </svg>商品價格
            </h5>
            @foreach ($option->prices->sortBy('unit_id')->values() as $price)
                <div class="border-top pt-2 mt-2">
                    @include('product/priceSpan', ['price' => $price])

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

        <div class="rounded bg-white shadow-sm mt-3 p-3 col">
            <h5 class="mb-3">
                <svg class="bi mx-2 mb-1" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#box-seam"/>
                </svg> 商品位置
            </h5>
            @foreach ($option->locations as $location)
                <div class="border-top pt-2 mt-2">
                    @include('product/locationSpan', ['location' => $location])
                </div>
            @endforeach
        </div>
    </div>

    @if (count($option->product->options) > 1)
        <div class="rounded bg-white shadow-sm mt-3 mx-n3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5>
                    <svg class="bi mx-2 mb-1" width="20" height="20" fill="currentColor">
                        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#diagram-3"/>
                    </svg> 其他子項目
                    <small class="text-muted">總計 {{ count($option->product->options) }}</small>
                </h5>
            </div>
            <div class="d-flex mt-3">
                @foreach ($option->product->options as $otherOption)
                    <div class="px-2" style="max-width: 50%;">
                        <a href="{{ route('product.show', $otherOption->id) }}">
                            <div class="d-flex justify-content-center align-items-center bg-white" style="width: 200px; max-width: 100%; height: 200px;">
                                <img class="mw-100 mh-100" src="{{ asset('img/product/'. $otherOption->image) }}">
                            </div>
                        
                            <h5 class="text-body mt-3">{{ $otherOption->name }}</h5>
                        </a>
                        @if ($option->defaultPrice)
                            <div class="">
                                @include('product/priceSpan', ['price' => $otherOption->defaultPrice])
                            </div>
                        @endif
                        @if ($option->defaultLocation)
                            <div class="d-inline-block p-1 pr-2 rounded shadow-sm mt-1 small">
                                @include('product/locationSpan', ['location' => $otherOption->defaultLocation])
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@include('components/destroyModal')

@endsection