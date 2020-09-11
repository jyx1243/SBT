@extends('layouts.master') 
@section('title', '商品 | ') 
@section('content')

<div class="container">
    <div class="rounded bg-white shadow-sm mt-4 mx-n3 p-3">
        <div class="d-flex justify-content-between align-items-end mb-3">
            <h6>項目總計 {{ count($options) }}</h6>
            <a href="{{ route('product.create') }}" class="btn btn-outline-secondary rounded-pill">
                <svg class="bi align-top" width="22" height="22" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#plus"/>
                </svg>  新增商品
            </a>
        </div>

        @forelse ($options as $option)
            <div class="border-top pt-3 mt-3">
                <div class="d-flex">
                    <a href="{{ route('product.show', $option->id) }}">
                        <div class="justify-content-center align-items-center d-none d-sm-flex bg-white" style="width: 150px; min-width: 150px; height: 150px;">
                            <img class="mw-100 mh-100" src="{{ asset('img/product/'. $option->image) }}">
                        </div>
                        <div class="justify-content-center align-items-center d-flex d-sm-none bg-white" style="width: 80px; min-width: 80px; height: 80px;">
                            <img class="mw-100 mh-100" src="{{ asset('img/product/'. $option->image) }}">
                        </div>
                    </a>
                    
                    <div class="d-flex flex-column flex-fill justify-content-start justify-content-sm-between ml-2 ml-sm-3">
                        <div class="d-flex justify-content-between">
                            <a class="h4 text-body" href="{{ route('product.show', $option->id) }}">
                                {{ $option->product->name }}
                                @isset($option->name)
                                    <span class="h5">/ {{ $option->name }}</span>
                                @endisset
                            </a>
                            <h4>
                                <span class="badge badge-secondary">{{ $option->product->category->name }}</span>
                            </h4>
                        </div>

                        <h6 class="text-muted"> {{ $option->product->subname }}</h6>

                        <div class="d-none d-sm-block">
                            @foreach ($option->prices as $price)
                                <span class="h5">$</span>
                                <span class="h4">{{ $price->value }}</span>
                                <span class="h6"> / {{ $price->unit->name }}</span>
                
                                @foreach ($price->sales as $sale)
                                    <span class="badge badge-secondary ml-1 align-baseline">
                                        <span class="p">
                                            優惠 ${{ $sale->value }} / {{ $sale->quantity }}{{ $price->unit->name }}
                                        </span>                             
                                    </span>
                                @endforeach

                                @unless ($loop->last)
                                    <span class="h6 mx-1">,</span>
                                @endunless
                            @endforeach
                        </div>

                        <div class="d-none d-sm-flex align-items-center">
                            @if ($option->defaultLocation)
                                <span class="p-1 pr-2 rounded shadow-sm">
                                    @include('product/locationSpan', ['location' => $option->defaultLocation])
                                </span>
                            @endif
                            
                            <a class="btn btn-outline-secondary rounded-pill ml-auto mr-2" href="{{ route('product.edit', $option->id) }}">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#pencil-square"/>
                                </svg>
                                <span class="d-none d-md-inline"> 修改</span>
                            </a>
                            <form method="POST" action="">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-outline-danger rounded-pill">
                                    <svg class="bi" width="18" height="18" fill="currentColor">
                                        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#trash"/>
                                    </svg>
                                    <span class="d-none d-md-inline"> 刪除</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="d-block d-sm-none mt-1">
                    @foreach ($option->prices as $price)
                        <span class="h5">$</span>
                        <span class="h4">{{ $price->value }}</span>
                        <span class="h6"> / {{ $price->unit->name }}</span>
                
                        @foreach ($price->sales as $sale)
                            <span class="badge badge-secondary ml-1 align-baseline">
                                <span class="p">
                                    優惠 ${{ $sale->value }} / {{ $sale->quantity }}{{ $price->unit->name }}
                                </span>                             
                            </span>
                        @endforeach
    
                        @unless ($loop->last)
                            <span class="h6 mx-1">,</span>
                        @endunless
                    @endforeach
    
                    <div class="d-flex align-items-center mt-1">
                        @if ($option->defaultLocation)
                            <span class="p-1 pr-2 rounded shadow-sm">
                                @include('product/locationSpan', ['location' => $option->defaultLocation])
                            </span>
                        @endif

                        <a class="btn btn-outline-secondary rounded-pill ml-auto mr-2" href="{{ route('product.edit', $option->id) }}">
                            <svg class="bi" width="18" height="18" fill="currentColor">
                                <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#pencil-square"/>
                            </svg>
                            <span class="d-none d-md-inline"> 修改</span>
                        </a>
                        <form method="POST" action="">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-outline-danger rounded-pill">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#trash"/>
                                </svg>
                                <span class="d-none d-md-inline"> 刪除</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <h1>No Product</h1>
        @endforelse
    </div>
</div>

@endsection