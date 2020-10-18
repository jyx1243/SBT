@extends('layouts.master') 
@section('title', '商品 | ') 
@section('content')

<div class="container">
    <div class="d-flex flex-column flex-lg-row-reverse">
        <div class="d-flex flex-column flex-sm-row flex-lg-column mt-4 ml-lg-3" style="min-width: 250px;">
            <div class="dropdown col px-0 col-lg-auto">
                <button class="dropdown-toggle btn btn-secondary shadow-sm col" type="button" 
                id="orderDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,0">
                    排列方式@if (array_has($queries, ['order'])){{ ' : ' . $queries['order'] }}@endif
                </button>
                <div class="dropdown-menu col border-0 shadow-sm" aria-labelledby="orderDropdown">
                    <a class="dropdown-item" href="{{ route('product.index') }}@if($queries)?{{ http_build_query(array_except($queries, ['order'])) }}@endif">ID (小至大)</a>
                    <a class="dropdown-item" href="{{ route('product.index').'?'.http_build_query(array_add(array_except($queries, ['order']), 'order', '最近觀看')) }}">最近觀看</a>
                    <a class="dropdown-item" href="{{ route('product.index').'?'.http_build_query(array_add(array_except($queries, ['order']), 'order', '最近新增')) }}">最近新增</a>
                    <a class="dropdown-item" href="{{ route('product.index').'?'.http_build_query(array_add(array_except($queries, ['order']), 'order', '商品類型')) }}">商品類型</a>
                </div>
            </div>

            <div class="dropdown col px-0 mt-2 mt-sm-0 ml-sm-2 d-lg-none">
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
            
            <div class="bg-white border-0 shadow-sm d-none d-lg-block mt-3 p-3">
                <h6 class="border-bottom pb-3 mb-3">
                    商品類別 @if (array_has($queries, ['category']))( 已選擇{{ count($queries['category']) }}項 )@endif
                </h6>
                <form method="GET" action="{{ route('product.index') }}">
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

        <div class="rounded bg-white shadow-sm flex-lg-fill p-3 mt-2 mt-lg-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">
                    @if (array_has($queries, ['search']))搜尋 "{{ $queries['search'] }}" | @endif
                    總計 {{ $options->total() }}
                </h6>
                <a href="{{ route('product.create') }}" class="btn btn-outline-secondary rounded-pill flex-shrink-0">
                    <svg class="bi align-top" width="22" height="22" fill="currentColor">
                        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#plus"/>
                    </svg>  新增商品
                </a>
            </div>

            @forelse ($options as $option)
                <div class="border-top pt-3 mt-3">
                    <div class="d-flex">
                        <a href="{{ route('product.show', $option->id) }}">
                            <img class="img-product-index" src="{{ asset('img/product/'. $option->image) }}">
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

                                {{-- 判斷商品是否有在清單裡 --}}
                                @if (in_array($option->id, session('list.options', array())))
                                    <a class="btn btn-secondary rounded-pill ml-auto" href="{{ route('list.delete', $option->id) }}">
                                        <svg class="bi mb-1" width="18" height="18" fill="currentColor">
                                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#trash"/>
                                        </svg>
                                        <span class="d-none d-md-inline"> 移除</span>
                                    </a>
                                @else
                                    <a class="btn btn-outline-secondary rounded-pill ml-auto" href="{{ route('list.add', $option->id) }}">
                                        <svg class="bi mb-1" width="18" height="18" fill="currentColor">
                                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#clipboard"/>
                                        </svg>
                                        <span class="d-none d-md-inline"> 清單</span>
                                    </a>
                                @endif
                                
                                <a class="btn btn-outline-secondary rounded-pill ml-2" href="{{ route('product.edit', $option->id) }}">
                                    <svg class="bi mb-1" width="18" height="18" fill="currentColor">
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
                    </div>

                    <div class="d-flex d-sm-none align-items-center mt-1">
                        @if ($option->defaultLocation)
                            <a href="{{ route('product.show', $option->id) }}#location" class="btn btn-light bg-white p-1 shadow-sm">
                                @include('product/Components/locationSpan', ['location' => $option->defaultLocation])
                            </a>
                        @endif

                        {{-- 判斷商品是否有在清單裡 --}}
                        @if (in_array($option->id, session('list.options', array())))
                            {{-- 移出清單 --}}
                            <a class="btn btn-secondary rounded-pill ml-auto" href="{{ route('list.delete', $option->id) }}">
                                <svg class="bi mb-1" width="18" height="18" fill="currentColor">
                                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#trash"/>
                                </svg>
                            </a>
                        @else
                            {{-- 加入清單 --}}
                            <a class="btn btn-outline-secondary rounded-pill ml-auto" href="{{ route('list.add', $option->id) }}">
                                <svg class="bi mb-1" width="18" height="18" fill="currentColor">
                                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#clipboard"/>
                                </svg>
                            </a>
                        @endif

                        {{-- 修改商品 --}}
                        <a class="btn btn-outline-secondary rounded-pill ml-2" href="{{ route('product.edit', $option->id) }}">
                            <svg class="bi" width="18" height="18" fill="currentColor">
                                <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#pencil-square"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="rounded bg-light py-5">
                    <h6 class="text-center mb-0">無任何項目</h6>
                </div>
            @endforelse
        </div>
    </div>

    @include('components/pagination', ['results' => $options])
</div>

@endsection