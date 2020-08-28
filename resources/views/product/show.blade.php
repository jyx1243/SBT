@extends('layouts.master') 
@section('title', $option->product->name. ' '. $option->name. ' | ') 
@section('content')

<div class="container">
    <div class="rounded bg-white shadow-sm mt-4 mx-n3 p-3">
        <div class="d-flex flex-column flex-sm-row">
            <div class="d-none d-md-flex justify-content-center align-items-center bg-white" style="width: 300px; min-width: 300px; height: 300px;">
                <img class="mw-100 mh-100" src="{{ asset('img/product/'. $option->image) }}">
            </div>
            <div class="d-none d-sm-flex d-md-none justify-content-center align-items-center bg-white" style="width: 200px; min-width: 200px; height: 200px;">
                <img class="mw-100 mh-100" src="{{ asset('img/product/'. $option->image) }}">
            </div>
            <div class="d-flex d-sm-none justify-content-center align-items-center bg-white" style="max-width: 100%; height: 300px;">
                <img class="mw-100 mh-100" src="{{ asset('img/product/'. $option->image) }}">
            </div>

            <div class="d-flex flex-column flex-fill ml-sm-3 mt-3 mt-sm-0">
                <div class="d-flex justify-content-between">
                    <h4>
                        {{ $option->product->name }}
                        @if ($option->name)
                            <span class="h5">/ {{ $option->name }}</span>
                        @endif
                    </h4>
                    <h4>
                        <span class="badge badge-dark badge-pill">{{ $option->product->category->name }}</span>
                    </h4>
                </div>

                <h6 class="text-muted"> {{ $option->product->subname }}</h6>

                <div class="rounded bg-light p-3 mt-2">
                    <h5 class="mb-3">商品價格</h5>
                    @foreach ($option->prices as $price)
                        <div class="border-top pt-2 mt-2">
                            <span class="h5">$</span>
                            <span class="h4">{{ $price->value }}</span>
                            <span class="h6"> / {{ $price->unit->name }}</span>
            
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

                <div class="rounded bg-light p-3 mt-3">
                    <h5 class="mb-3">商品位置</h5>
                    @foreach ($option->locations as $location)
                        <div class="border-top pt-2 mt-2">
                            @include('product/locationSpan', ['location' => $location])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if (count($option->product->options) > 1)
        <div class="rounded bg-white shadow-sm mt-3 mx-n3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5>{{ $option->product->name }} - 相關商品</h5>
                <h6 class="text-muted">項目總計 {{ count($option->product->options) }}</h6>
            </div>
            <div class="d-flex">
                @foreach ($option->product->options as $option)
                    <div class="px-2" style="max-width: 50%;">
                        <a href="{{ route('product.show', $option->id) }}">
                            <div class="d-flex justify-content-center align-items-center bg-white" style="width: 200px; max-width: 100%; height: 200px;">
                                <img class="mw-100 mh-100" src="{{ asset('img/product/'. $option->image) }}">
                            </div>
                        
                            <h5 class="text-body mt-3">{{ $option->name }}</h5>
                        </a>
                        @if ($option->defaultPrice)
                            <div class="">
                                <span class="h5">$</span>
                                <span class="h4">{{ $option->defaultPrice->value }}</span>
                                <span class="h6"> / {{ $option->defaultPrice->unit->name }}</span>
                            </div>
                        @endif
                        @if ($option->defaultLocation)
                            <div class="d-inline-block p-1 pr-2 rounded shadow-sm mt-1 small">
                                @include('product/locationSpan', ['location' => $option->defaultLocation])
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@endsection