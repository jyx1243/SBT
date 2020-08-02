@extends('layouts.master') 
@section('title', '搜尋結果') 
@section('content')

<div class="container">
    <div class="rounded bg-light my-3 mx-n3 p-3">
        <div class="row justify-content-between align-items-end mb-3">
            <div class="col-auto">
                <h6>項目總計 - 4</h6>
                {{-- <h6>項目總計 {{ count($products) }}</h6> --}}
            </div>
            <div class="col-auto">
                <a href="" class="btn btn-secondary rounded-pill">
                    <svg class="bi align-top" width="22" height="22" fill="currentColor">
                        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#plus"/>
                    </svg>  新增商品
                </a>
            </div>
        </div>

        @forelse ($products as $product)
            <div class="row border-top pt-3 flex-nowrap" style="height: 150px;">
                <div class="ml-3 justify-content-center align-items-center d-none d-sm-flex bg-white" style="height: 175px; width: 175px">
                    <img class="mw-100 mh-100" src="{{ asset('uploads/product/'. $product->image) }}">
                </div>
                <div class="ml-3 justify-content-center align-items-center d-flex d-sm-none bg-white" style="height: 125px; width: 125px">
                    <img class="mw-100 mh-100" src="{{ asset('uploads/product/'. $product->image) }}">
                </div>
                <div class="col bg-success">
                    <div class="row">
                        <div class="col pr-0" style="width: 0px;">
                            <h4 class="text-truncate">{{ $product->title }}</h4>
                            <h6 class="text-muted text-truncate"> {{ $product->subtitle }}</h6>
                        </div>
                        <div class="col-auto ml-auto">
                            <h4>#{{ $product->id }}</h4>
                        </div>
                    </div>
                    <h6>{{ $product->description }}</h6>
                </div>
            </div>
            <div class="row align-items-center mb-3">
                <div class="d-none d-sm-flex" style="width: 175px;"></div>
                <div class="col ml-sm-3">
                    <h3><span class="badge badge-dark badge-pill">藥材</span></h3>
                </div>
                <a class="btn btn-outline-secondary rounded-pill ml-auto mr-2" href="{{ route('admin.product.edit', $product->id) }}">
                    <svg class="bi" width="20" height="20" fill="currentColor">
                        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#pencil-square"/>
                    </svg>  修改
                </a>
                <form method="POST" action="{{ route('admin.product.destroy', $product->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-outline-danger rounded-pill mr-3">
                        <svg class="bi" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#trash"/>
                        </svg>  刪除
                    </button>
                </form>
            </div>
        @empty
            <h1>No Product</h1>
        @endforelse
    </div>
</div>

@endsection