@extends('layouts.master') 
@section('title', '') 
@section('content')

<div class="container">
    <h1 class="display-2 text-center my-5">SBT</h1>
    <div class="rounded bg-white shadow-sm mt-4 mx-n3 p-3">
        <div class="d-flex justify-content-center">
            @foreach ($options as $option)
                <div class="px-2 col-6 col-md-4 col-lg-3">
                    <a href="{{ route('product.show', $option->id) }}">
                        <div class="d-flex justify-content-center align-items-center bg-light" style="height: 200px;">
                            <img class="mw-100 mh-100" src="{{ asset('img/product/'. $option->image) }}">
                        </div>
                    
                        <h5 class="text-body mt-3">{{ $option->name }}</h5>
                    </a>
                    @if ($option->defaultPrice)
                        <div class="">
                            @include('product/priceSpan', ['price' => $option->defaultPrice])
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
</div>

@endsection