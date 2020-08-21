@extends('layouts.master') 
@section('title', '產品 | ') 
@section('content')

<div class="container">
    <div class="rounded bg-light my-3 mx-n3 p-3">
        <div class="row justify-content-between align-items-end mb-3">
            <div class="col-auto">
                <h6>項目總計 {{ count($options) }}</h6>
            </div>
            <div class="col-auto">
                <a href="" class="btn btn-secondary rounded-pill">
                    <svg class="bi align-top" width="22" height="22" fill="currentColor">
                        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#plus"/>
                    </svg>  新增商品
                </a>
            </div>
        </div>

        @forelse ($options as $option)
            <div class="row border-top pt-3 flex-nowrap">
                <div class="ml-3 justify-content-center align-items-center d-none d-sm-flex bg-white" style="height: 150px; width: 150px">
                    <img class="mw-100 mh-100" src="{{ asset('img/product/'. $option->image) }}">
                </div>
                <div class="ml-3 justify-content-center align-items-center d-flex d-sm-none bg-white" style="height: 100px; width: 100px">
                    <img class="mw-100 mh-100" src="{{ asset('img/product/'. $option->image) }}">
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col pr-0" style="width: 0px;">
                            <h4 class="text-truncate">
                                {{ $option->product->name }}
                                @if ($option->name !== null)
                                    <span class="h5">/ {{ $option->name }}</span>
                                @endif
                            </h4>
                        </div>
                        <div class="col-auto ml-auto">
                            <h4><span class="badge badge-dark badge-pill">{{ $option->product->category->name }}</span></h4>
                        </div>
                    </div>
                    <h6 class="text-muted"> {{ $option->product->subname }}</h6>
                    <div class="mb-2">
                        @foreach ($option->price as $price)
                                <span class="h5">$</span>
                                <span class="h4">{{ $price->value }}</span>
                                <span class="h6 mr-2"> / {{ $price->unit->name }}</span>
        
                                @foreach ($price->sale as $sale)
                                <span class="badge badge-danger mr-2">
                                    <span class="h5">優惠 $</span>
                                    <span class="h4">{{ $sale->value }}</span>
                                    <span class="h6"> / {{ $sale->quantity }}{{ $price->unit->name }}</span>
                                </span>
                                @endforeach
                            @endforeach
                    </div>
                </div>
            </div>

            

            <div class="row align-items-center mb-3">
                <div class="d-none d-sm-flex mr-3" style="width: 150px;"></div>

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
                    <button type="submit" class="btn btn-outline-danger rounded-pill mr-3">
                        <svg class="bi" width="18" height="18" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#trash"/>
                        </svg>
                        <span class="d-none d-md-inline"> 刪除</span>
                    </button>
                </form>
            </div>
        @empty
            <h1>No Product</h1>
        @endforelse
    </div>
</div>

@endsection