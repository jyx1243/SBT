@extends('layouts.master') 
@section('title', '商品 | ') 
@section('content')

<div class="container">
    <div class="d-flex flex-column flex-lg-row-reverse">
        <div class="d-flex flex-column flex-sm-row flex-lg-column mt-4 ml-lg-3" style="min-width: 250px;">
            <div class="dropdown col col-lg-auto px-0 mr-sm-2 mr-lg-0">
                <button class="dropdown-toggle btn btn-secondary shadow-sm col" type="button" 
                id="orderDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,0">
                    排列方式@if (array_has($queries, ['order'])){{ ' : ' . $queries['order'] }}@endif
                </button>
                <div class="dropdown-menu col border-0 shadow-sm" aria-labelledby="orderDropdown">
                    <a class="dropdown-item" href="{{ route('product.index') }}@if($queries)?{{ http_build_query(array_except($queries, ['order'])) }}@endif">ID</a>
                    <a class="dropdown-item" href="{{ route('product.index').'?'.http_build_query(array_add(array_except($queries, ['order']), 'order', 'used_at-desc')) }}">最近觀看</a>
                    <a class="dropdown-item" href="{{ route('product.index').'?'.http_build_query(array_add(array_except($queries, ['order']), 'order', 'category_id-asc')) }}">商品類別</a>
                    <a class="dropdown-item" href="{{ route('product.index').'?'.http_build_query(array_add(array_except($queries, ['order']), 'order', 'created_at-desc')) }}">最近新增</a>
                </div>
            </div>

            <div class="dropdown col px-0 mt-2 mt-sm-0 d-lg-none">
                <button class="dropdown-toggle btn btn-secondary shadow-sm col" type="button" 
                id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,0">
                    商品類別 @if (array_has($queries, ['category']))( 已選擇{{ count($queries['category']) }}項 )@endif
                </button>
                <div class="dropdown-menu col border-0 shadow-sm" aria-labelledby="categoryDropdown">
                    <form class="px-3 py-1" method="GET" action="{{ route('product.index') }}">
                        @foreach (array_except($queries, ['category']) as $index => $query) 
                            <input type="hidden" name="{{ $index }}" value="{{ $query }}">
                        @endforeach
                        @foreach (App\Models\Category::all() as $category)
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="dropCategory{{ $category->id }}" name="category[]" value="{{ $category->id }}"
                                    @if (array_has($queries, ['category']) && in_array($category->id, $queries['category'])) checked @endif>
                                    <label class="custom-control-label d-flex justify-content-between" for="dropCategory{{ $category->id }}">
                                        <span>{{ $category->name }}</span>
                                        <span>( {{ count($category->options) }} )</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex mt-3">
                            <a class="btn btn-outline-secondary rounded-pill col mr-2" 
                            href="{{ route('product.index') }}@if($queries)?{{ http_build_query(array_except($queries, ['category'])) }}@endif">清除</a>
                            <button type="submit" class="btn btn-secondary rounded-pill col">篩選</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="bg-white border-0 shadow-sm d-none d-lg-flex flex-column mt-3 p-3">
                <h6 class="border-bottom pb-3 mb-3">
                    商品類別 @if (array_has($queries, ['category']))( 已選擇{{ count($queries['category']) }}項 )@endif
                </h6>
                <form class="flex-fill" method="GET" action="{{ route('product.index') }}">
                    @foreach (array_except($queries, ['category']) as $index => $query) 
                        <input type="hidden" name="{{ $index }}" value="{{ $query }}">
                    @endforeach
                    @foreach (App\Models\Category::all() as $category)
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="divCategory{{ $category->id }}" name="category[]" value="{{ $category->id }}"
                                @if (array_has($queries, ['category']) && in_array($category->id, $queries['category'])) checked @endif>
                                <label class="custom-control-label d-flex justify-content-between" for="divCategory{{ $category->id }}">
                                    <span>{{ $category->name }}</span>
                                    <span>( {{ $categoryCount[$category->id] }} )</span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex mt-3">
                        <a class="btn btn-outline-secondary rounded-pill col mr-2" 
                        href="{{ route('product.index') }}@if($queries)?{{ http_build_query(array_except($queries, ['category'])) }}@endif">清除</a>
                        <button type="submit" class="btn btn-secondary rounded-pill col">篩選</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="rounded bg-white shadow-sm mt-2 mt-lg-4 mr-lg-0 p-3 flex-lg-fill">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">項目總計 {{ $options->total() }}</h6>
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
                            <img class="img-list" src="{{ asset('img/product/'. $option->image) }}">
                        </a>
                        
                        <div class="d-flex flex-column flex-fill justify-content-start justify-content-sm-between ml-2 ml-sm-3">
                            <div class="d-flex justify-content-between">
                                <a class="h4 text-body" href="{{ route('product.show', $option->id) }}">
                                    {{ $option->product->name }}
                                    @if($option->name)
                                        <span class="h5">/ {{ $option->name }}</span>
                                    @endif
                                </a>
                                <h4><a href="{{ route('product.index') }}?category[]={{ $option->product->category->id }}" class="badge badge-secondary">
                                    {{ $option->product->category->name }}
                                </a></h4>
                            </div>

                            <h6 class="text-muted"> {{ $option->product->subname }}</h6>

                            <div class="d-none d-sm-block">
                                @foreach ($option->prices->sortBy('unit_id')->values()->take(2) as $price)
                                    @include('product/Components/priceSpan', ['price' => $price])

                                    @foreach ($price->sales as $sale)
                                        <span class="badge badge-secondary ml-1">
                                            優惠 ${{ $sale->value }} / {{ $sale->quantity }}{{ $price->unit->name }}                            
                                        </span>
                                    @endforeach 

                                    <span> , </span>

                                    @if ($loop->last)
                                        <a href="{{ route('product.show', $option->id) }}#price" class="text-body">更多價格</a>   
                                    @endif
                                @endforeach
                            </div>

                            <div class="d-none d-sm-flex align-items-center">
                                @if ($option->defaultLocation)
                                    <a href="{{ route('product.show', $option->id) }}#location" class="btn btn-light bg-white p-1 shadow-sm">
                                        @include('product/Components/locationSpan', ['location' => $option->defaultLocation])
                                    </a>
                                @endif
                                
                                <a class="btn btn-outline-secondary rounded-pill ml-auto" href="{{ route('product.edit', $option->id) }}">
                                    <svg class="bi" width="18" height="18" fill="currentColor">
                                        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#pencil-square"/>
                                    </svg>
                                    <span class="d-none d-md-inline"> 修改</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="d-block d-sm-none mt-1">
                        @foreach ($option->prices->sortBy('unit_id')->values()->take(2) as $price)
                            @include('product/Components/priceSpan', ['price' => $price])

                            @foreach ($price->sales as $sale)
                                <span class="badge badge-secondary ml-1">
                                    優惠 ${{ $sale->value }} / {{ $sale->quantity }}{{ $price->unit->name }}                            
                                </span>
                            @endforeach 

                            <span> , </span>

                            @if ($loop->last)
                                <a href="{{ route('product.show', $option->id) }}#price" class="text-body">更多價格</a>   
                            @endif
                        @endforeach
        
                        <div class="d-flex align-items-center mt-1">
                            @if ($option->defaultLocation)
                                <a href="{{ route('product.show', $option->id) }}#location" class="btn btn-light bg-white p-1 shadow-sm">
                                    @include('product/Components/locationSpan', ['location' => $option->defaultLocation])
                                </a>
                            @endif

                            <a class="btn btn-outline-secondary rounded-pill ml-auto" href="{{ route('product.edit', $option->id) }}">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#pencil-square"/>
                                </svg>
                                <span class="d-none d-md-inline"> 修改</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <h1>No Product</h1>
            @endforelse
        </div>
    </div>

    @include('components/pagination', ['results' => $options])
</div>

@endsection