@extends('layouts.master') 
@section('title', '修改 ' . $option->product->name . ' ' . $option->name . ' | ') 
@section('content')

<div class="container">
    @include('components/error')
    
    <form method="POST" action="{{ route('product.update', $option->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="rounded bg-white shadow-sm mt-4 mx-n3 px-3 py-4">
            <h2 class="mb-5 mt-3 text-center">修改 {{ $option->product->name }}
                <small class="text-muted"> {{ $option->name }}</small>
            </h2>
            <h4 class="mb-4">
                <svg class="bi mx-2 mb-1" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#info-circle"/>
                </svg>商品基本資訊
            </h4>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="name">
                        名稱<small class="ml-1 text-danger">*必填<span class="ml-1 text-muted">最多10字</span></small>
                    </label>
                    <input type="text" class="form-control" value="{{ old('name') ?? $option->product->name }}" id="name" name="name" placeholder="商品名稱" maxlength="10" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="category">
                        類型<small class="ml-1 text-danger">*必填</small>
                    </label>
                    <select class="custom-select" id="category" name="category" required>
                        <option value="">選擇類型</option>
                        @foreach ($categorys as $category)
                            <option value="{{ $category->id }}" @if ( old('category') ?? $option->product->category->id == $category->id ) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="subname">
                    別名<small class="ml-1 text-muted">最多40字</small>
                </label>
                <input type="text" class="form-control" value="{{ old('subname') ?? $option->product->subname }}" id="subname" name="subname" placeholder="商品別名" maxlength="40">
                <small id="subnameHelp" class="form-text text-muted">
                    輸入所有可能的別名、諧音，以便更容易搜尋該商品
                </small>
            </div>
        
            <hr class="my-4">
            <h4 class="mb-4">
                <svg class="bi mx-2 mb-1" width="20" height="20" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#diagram-3"/>
                </svg>子項目資訊
            </h4>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="optionName">
                        子項目名稱<small class="ml-1 text-muted">最多10字</small>
                    </label>
                    <input type="text" class="form-control" value="{{ old('optionName') ?? $option->name }}" id="optionName" name="optionName" placeholder="商品子項名稱" maxlength="10">
                    <small id="subnameHelp" class="form-text text-muted">
                        多種有價格差異之子項目屬於同一商品，輸入名稱以便區分各子項目
                    </small>
                </div>
                <div class="form-group col-md-4">
                    <label for="image">
                        圖片
                    </label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" value="{{ old('image') }}" id="image" name="image">
                        <label class="custom-file-label" for="image" data-browse="瀏覽">選擇圖片檔案</label>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <h4 class="mb-4">
                <svg class="bi mx-2" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#tag"/>
                </svg>價格資訊
            </h4>
            <div class="form-row">
                <div class="form-group col-8">
                    <label for="price">
                        價格 <small class="text-danger">*必填</small>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white pl-3 pr-1 border-right-0">
                                <span class="border-right pr-3">$</span>
                            </span>
                        </div>
                        <input type="number" class="form-control border-left-0" value="{{ old('price') }}" id="price" name="price" placeholder="每單位商品價格" step='5' required>
                    </div>
                </div>
                <div class="form-group col-4">
                    <label for="unit">
                        單位 <small class="text-danger">*必填</small>
                    </label>
                    <select class="custom-select" id="unit" name="unit" required>
                        <option value="">選擇單位</option>
                        <optgroup label="個數">
                            @foreach ($units->where('standard', '個數') as $unit)
                                <option value="{{ $unit->id }}" @if ( old('unit') == $unit->id ) selected @endif>
                                    {{ $unit->name }}
                                </option>
                            @endforeach
                        </optgroup>
                        <optgroup label="台制">
                            @foreach ($units->where('standard', '台制') as $unit)
                                <option value="{{ $unit->id }}" @if ( old('unit') == $unit->id ) selected @endif>
                                    {{ $unit->name }}
                                </option>
                            @endforeach
                        </optgroup>
                        <optgroup label="公制">
                            @foreach ($units->where('standard', '公制') as $unit)
                                <option value="{{ $unit->id }}" @if ( old('unit') == $unit->id ) selected @endif>
                                    {{ $unit->name }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultPrice" name="defaultPrice" value="1" checked>
                <label class="custom-control-label" for="defaultPrice">設為默認價格</label>
            </div>
       
            <hr class="my-4">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h4>
                    <svg class="bi mx-2 mb-1" width="18" height="18" fill="currentColor">
                        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#box-seam"/>
                    </svg>位置資訊
                </h4>
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-toggle="modal" data-target="#createLocationModal">
                    <svg class="bi align-top" width="22" height="22" fill="currentColor">
                        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#plus"/>
                    </svg>  新增位置
                </button>
            </div>
            @foreach ($option->locations as $location)
                <div class="d-flex justify-content-between align-content-center">
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" class="custom-control-input" id="defaultLocation{{ $loop->iteration }}" name="defaultLocation" 
                        value="{{ $location->id }}" @if ( old('defaultLocation') ?? $option->default_location_id == $location->id ) checked @endif>
                        <label class="custom-control-label" for="defaultLocation{{ $loop->iteration }}">
                            <span class="h6">位置 {{ $loop->iteration }}</span> 設為默認位置
                        </label>
                    </div>

                    <button type="button" class="btn btn-link text-danger" data-toggle="modal" data-target="#destroyLocationModal" data-location="{{ $location->id }}" data-id="{{ $loop->iteration }}">
                        <svg class="bi" width="18" height="18" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#trash"/>
                        </svg> 刪除
                    </button>
                </div>
                <div class="form-row">
                    <div class="form-group col-6 col-md-3">
                        <select class="custom-select" id="zone" name="zone[]" required>
                            <option value="">選擇區域</option>
                            @foreach ($zones as $zone)
                                <option value="{{ $zone->id }}" @if ( old('zone') ?? $location->zone->id == $zone->id ) selected @endif>
                                    {{ $zone->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6 col-md-3">
                        <select class="custom-select" id="layer" name="layer[]">
                            <option value="">選擇層</option>
                            <option value="上" @if ( old('layer') ?? $location->layer == '上' ) selected @endif>上層</option>
                            <option value="中" @if ( old('layer') ?? $location->layer == '中' ) selected @endif>中層</option>
                            <option value="下" @if ( old('layer') ?? $location->layer == '下' ) selected @endif>下層</option>
                        </select>
                    </div>
                    <div class="form-group col-6 col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white pl-3 pr-1 border-right-0">
                                    <span class="border-right pr-3">
                                        <svg class="bi" width="18" height="18" fill="currentColor">
                                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#arrow-right-circle"/>
                                        </svg>
                                    </span>
                                </span>
                            </div>
                            <input type="number" class="form-control border-left-0 border-right-0" value="{{ old('col') ?? $location->col }}" id="col" name="col[]" max="100">
                            <div class="input-group-append">
                                <span class="input-group-text bg-white pr-3 pl-1 border-left-0">
                                    <span class="border-left pl-3">欄</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-6 col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white pl-3 pr-1 border-right-0">
                                    <span class="border-right pr-3">
                                        <svg class="bi" width="18" height="18" fill="currentColor">
                                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#arrow-down-circle"/>
                                        </svg>
                                    </span>
                                </span>
                            </div>
                            <input type="number" class="form-control border-left-0 border-right-0" value="{{ old('row') ?? $location->row }}" id="row" name="row[]" max="100">
                            <div class="input-group-append">
                                <span class="input-group-text bg-white pr-3 pl-1 border-left-0">
                                    <span class="border-left pl-3">列</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-secondary rounded-pill d-flex px-4 py-2 mx-auto mt-3">確定修改</button>
    </form>
</div>

<div class="modal fade" id="createLocationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">新增位置 {{ count($option->locations)+1 }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('location.store', $option->id) }}">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="newZone">
                                區域 <small class="text-danger">*必填</small>
                            </label>
                            <select class="custom-select" id="newZone" name="newZone" required>
                                <option value="">選擇區域</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}" @if ( old('newZone') == $zone->id ) selected @endif>
                                        {{ $zone->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="newLayer">
                                層
                            </label>
                            <select class="custom-select" id="newLayer" name="newLayer">
                                <option value="">選擇層</option>
                                <option value="1" @if ( old('newLayer') == 1 ) selected @endif>上層</option>
                                <option value="2" @if ( old('newLayer') == 2 ) selected @endif>中層</option>
                                <option value="3" @if ( old('newLayer') == 3 ) selected @endif>下層</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="newCol">
                                欄<small class="ml-1 text-muted">最大100</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white pl-3 pr-1 border-right-0">
                                        <span class="border-right pr-3">
                                            <svg class="bi" width="18" height="18" fill="currentColor">
                                                <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#arrow-right-circle"/>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                                <input type="number" class="form-control border-left-0 border-right-0" value="{{ old('newCol') }}" id="newCol" name="newCol" max="100">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white pr-3 pl-1 border-left-0">
                                        <span class="border-left pl-3">欄</span>
                                    </span>
                                </div>
                            </div>
                            <small id="subnameHelp" class="form-text text-muted">
                                由左至右的排列位置
                            </small>
                        </div>
                        <div class="form-group col-6">
                            <label for="newRow">
                                列<small class="ml-1 text-muted">最大100</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white pl-3 pr-1 border-right-0">
                                        <span class="border-right pr-3">
                                            <svg class="bi" width="18" height="18" fill="currentColor">
                                                <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#arrow-down-circle"/>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                                <input type="number" class="form-control border-left-0 border-right-0" value="{{ old('newRow') }}" id="newRow" name="newRow" max="100">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white pr-3 pl-1 border-left-0">
                                        <span class="border-left pl-3">列</span>
                                    </span>
                                </div>
                            </div>
                            <small id="subnameHelp" class="form-text text-muted">
                                由上至下的排列位置
                            </small>
                        </div>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="newDefaultLocation" name="newDefaultLocation" value="1">
                        <label class="custom-control-label" for="newDefaultLocation">設為默認位置</label>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 mr-2" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-secondary rounded-pill px-4">新增</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('components/destroyModal')

@endsection