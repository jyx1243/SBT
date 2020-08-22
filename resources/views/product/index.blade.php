@extends('layouts.master') 
@section('title', '產品 | ') 
@section('content')

<div class="container">
    <div class="rounded bg-light my-3 mx-n3 p-3">
        <div class="d-flex justify-content-between align-items-end mb-3">
            <h6>項目總計 {{ count($options) }}</h6>
            <a href="" class="btn btn-secondary rounded-pill">
                <svg class="bi align-top" width="22" height="22" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#plus"/>
                </svg>  新增商品
            </a>
        </div>

        @forelse ($options as $option)
            <div class="border-top py-3">
                <div class="d-flex">
                    <div class="justify-content-center align-items-center d-none d-sm-flex bg-white" style="width: 150px; min-width: 150px; height: 150px;">
                        <img class="mw-100 mh-100" src="{{ asset('img/product/'. $option->image) }}">
                    </div>
                    <div class="justify-content-center align-items-center d-flex d-sm-none bg-white" style="width: 80px; min-width: 80px; height: 80px;">
                        <img class="mw-100 mh-100" src="{{ asset('img/product/'. $option->image) }}">
                    </div>
                    
                    <div class="d-flex flex-column flex-fill justify-content-start justify-content-sm-between ml-2 ml-sm-3">
                        <div class="d-flex justify-content-between">
                            <h4 class="text-truncate">
                                {{ $option->product->name }}
                                @if ($option->name !== null)
                                    <span class="h5">/ {{ $option->name }}</span>
                                @endif
                            </h4>
                            <h4>
                                <span class="badge badge-dark badge-pill">{{ $option->product->category->name }}</span>
                            </h4>
                        </div>

                        <h6 class="text-muted"> {{ $option->product->subname }}</h6>

                        <div class="d-none d-sm-block">
                            @foreach ($option->price as $price)
                                <span class="h5">$</span>
                                <span class="h4">{{ $price->value }}</span>
                                <span class="h6"> / {{ $price->unit->name }}</span>
                
                                @foreach ($price->sale as $sale)
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
                            @include('product/locationSpan')
                            
                            <a class="btn btn-outline-secondary rounded-pill ml-auto mr-2" href="">
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
                    @foreach ($option->price as $price)
                        <span class="h5">$</span>
                        <span class="h4">{{ $price->value }}</span>
                        <span class="h6"> / {{ $price->unit->name }}</span>
                
                        @foreach ($price->sale as $sale)
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
                        @include('product/locationSpan')
                        
                        <a class="btn btn-outline-secondary rounded-pill ml-auto mr-2" href="">
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