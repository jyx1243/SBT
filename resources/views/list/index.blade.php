@extends('layouts.master') 
@section('title', '清單 | ') 
@section('content')

<div class="container">
    <div class="rounded bg-white shadow-sm mt-4 p-3">
        <h2 class="my-4 text-center">清單</h2>

        <div class="d-flex align-items-center mb-3">
            <h6 class="mb-0">
                總計 {{ count($options) }}
            </h6>
            <a class="btn btn-outline-danger rounded-pill ml-auto" href="{{ route('list.deleteAll') }}">
                <svg class="bi" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#trash"/>
                </svg> 移除所有商品
            </a>
            <div class="dropdown">
                <button class="btn btn-outline-secondary rounded-pill dropdown-toggle px-3 ml-2" type="button" data-toggle="dropdown">
                    設定所有單位
                </button>
                <div class="dropdown-menu border-0 shadow-sm" id="unitDropdownMenu">
                    @foreach (App\Models\Unit::all()->groupBy('standard') as $groups)
                        <h6 class="dropdown-header">{{ $groups->first()->standard }}</h6>
                        @foreach ($groups as $unit)
                            <button class="dropdown-item text-center" type="button" id="{{ $unit->id }}">{{ $unit->name }}</button>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>

        @forelse ($options as $option)
            <div class="border-top pt-3 mt-3">
                <div class="d-flex">
                    <a href="{{ route('product.show', $option->id) }}">
                        <img class="img-product-list" src="{{ asset('img/product/'. $option->image) }}">
                    </a>
                    
                    <div class="d-flex flex-column flex-fill justify-content-between ml-2 ml-sm-3">
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

                        <div class="d-none d-sm-flex justify-content-end align-items-center mt-1">
                            <a class="text-danger flex-shrink-0" href="{{ route('list.delete', $option->id) }}">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#trash"/>
                                </svg> 移除
                            </a>
        
                            <div class="input-group ml-3" style="max-width: 120px; min-width: 110px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary px-2" type="button" name="dashBtn">
                                        <svg class="bi" width="18" height="18" fill="currentColor">
                                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#dash"/>
                                        </svg>
                                    </button>
                                </div>
                                <input type="text" class="form-control text-center" placeholder="數量" name="quantity[]">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary px-2" type="button" name="plusBtn">
                                        <svg class="bi" width="18" height="18" fill="currentColor">
                                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#plus"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
        
                            <select class="custom-select ml-3" name="unit[]" style="max-width: 120px;" required>
                                <option>單位</option>
                                @foreach (App\Models\Unit::all()->groupBy('standard') as $groups)
                                    <optgroup label="{{ $groups->first()->standard }}">
                                        @foreach ($groups as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="d-flex d-sm-none justify-content-end align-items-center mt-1">
                    <a class="text-danger flex-shrink-0" href="{{ route('list.delete', $option->id) }}">
                        <svg class="bi" width="18" height="18" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#trash"/>
                        </svg> 移除
                    </a>

                    <div class="input-group ml-2" style="max-width: 120px; min-width: 110px;">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary px-2" type="button" name="dashBtn">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#dash"/>
                                </svg>
                            </button>
                        </div>
                        <input type="text" class="form-control text-center" value="0" placeholder="數量" name="quantity[]">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary px-2" type="button" name="plusBtn">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#plus"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <select class="custom-select ml-2" name="unit[]" style="max-width: 120px;" required>
                        <option>單位</option>
                        @foreach (App\Models\Unit::all()->groupBy('standard') as $groups)
                            <optgroup label="{{ $groups->first()->standard }}">
                                @foreach ($groups as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
        @empty
            <div class="rounded bg-light py-5">
                <h6 class="text-center mb-0">清單內無任何項目</h6>
            </div>
        @endforelse
    </div>
</div>

@endsection