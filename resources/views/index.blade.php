@extends('layouts.master') 
@section('title', '') 
@section('content')

<div class="container">
    <div class="text-center my-5">
        <h1 class="display-1 mb-0">SBT</h1>
        <h2>順保堂中藥房</h2>
    </div>
    <div class="rounded bg-white shadow-sm p-3">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0">最近觀看的商品</h6>
            <a href="{{ route('product.index').'?order=used_at-desc' }}" class="btn btn-outline-secondary rounded-pill px-3">查看全部</a>
        </div>
        <div class="d-flex flex-wrap mx-n3">
            @foreach ($options as $option)
                <div class="col-6 col-sm-4 col-lg-2 mt-3 px-3">
                    @include('product/Components/productCard', ['option' => $option])
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection