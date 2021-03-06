@extends('layouts.master') 
@section('title', '新增 "'.$product->name.'" 的品項 | ') 
@section('content')

<div class="container">
    @include('components/error')

    <form method="POST" action="{{ route('product.storeOption', $product->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="rounded bg-white shadow-sm mt-4 p-3">
            <h2 class="my-4 text-center">新增 "{{ $product->name }}" 的品項</h2>
            <h4 class="mb-4">
                <svg class="bi mx-2 mb-1" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#info-circle"/>
                </svg>基本資訊
            </h4>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="name">
                        名稱
                    </label>
                    <input type="text" class="form-control" value="{{ $product->name }}" id="name" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="category">
                        類型
                    </label>
                    <select class="custom-select" id="category" disabled>
                        <option value="">{{ $product->category->name }}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="subname">
                    別名
                </label>
                <input type="text" class="form-control" value="{{ $product->subname }}" id="subname" readonly>
            </div>
        
            <hr class="my-4">
            <h4 class="mb-4">
                <svg class="bi mx-2 mb-1" width="20" height="20" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#diagram-3"/>
                </svg>品項
            </h4>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="optionName">
                        品項名稱<small class="ml-1 text-muted">最多10字</small>
                    </label>
                    <input type="text" class="form-control" value="{{ old('optionName') }}" id="optionName" name="optionName" placeholder="商品品項名稱" maxlength="10">
                    <small id="subnameHelp" class="form-text text-muted">
                        多種有價格差異之品項屬於同一商品，輸入名稱以便區分各品項
                    </small>
                </div>
                <div class="form-group col-md-4">
                    <label for="image">
                        圖片
                    </label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @if ($errors->has('image')) is-invalid @endif" value="{{ old('image') }}" id="image" name="image">
                        <label class="custom-file-label" for="image" data-browse="瀏覽">選擇圖片檔案</label>
                    </div>
                    <div class="invalid-feedback">
                        @foreach ($errors->get('name') as $error)
                            {{ $error . ' ' }}
                        @endforeach
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <h4 class="mb-4">
                <svg class="bi mx-2" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#tag"/>
                </svg>價格
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
                        <input type="number" class="form-control border-left-0" value="{{ old('price') }}" id="price" name="price" placeholder="每單位商品價格" min="0" required>
                    </div>
                </div>
                <div class="form-group col-4">
                    <label for="unit">
                        單位 <small class="text-danger">*必填</small>
                    </label>
                    <select class="custom-select" id="unit" name="unit" required>
                        <option value="">選擇單位</option>
                        @foreach (App\Models\Unit::all()->groupBy('standard') as $groups)
                            <optgroup label="{{ $groups->first()->standard }}">
                                @foreach ($groups as $unit)
                                    <option value="{{ $unit->id }}" @if ( old('unit') == $unit->id ) selected @endif>
                                        {{ $unit->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultPrice" name="defaultPrice" value="1" checked>
                <label class="custom-control-label" for="defaultPrice">設為默認價格</label>
            </div>
       
            <hr class="my-4">
            <h4 class="mb-4">
                <svg class="bi mx-2 mb-1" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#box-seam"/>
                </svg>位置
            </h4>
            <div class="form-row">
                <div class="form-group col-6 col-md-3">
                    <label for="zone">
                        區域 <small class="text-danger">*必填</small>
                    </label>
                    <select class="custom-select" id="zone" name="zone" required>
                        <option value="">選擇區域</option>
                        @foreach (App\Models\Zone::all() as $zone)
                            <option value="{{ $zone->id }}" @if ( old('zone') == $zone->id ) selected @endif>
                                {{ $zone->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6 col-md-3">
                    <label for="layer">
                        層
                    </label>
                    <select class="custom-select" id="layer" name="layer">
                        <option value="">選擇層</option>
                        <option value="1" @if ( old('layer') == 1 ) selected @endif>上層</option>
                        <option value="2" @if ( old('layer') == 2 ) selected @endif>中層</option>
                        <option value="3" @if ( old('layer') == 3 ) selected @endif>下層</option>
                    </select>
                </div>
                <div class="form-group col-6 col-md-3">
                    <label for="col">
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
                        <input type="number" class="form-control border-left-0 border-right-0" value="{{ old('col') }}" id="col" name="col" max="100" min="0">
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
                <div class="form-group col-6 col-md-3">
                    <label for="row">
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
                        <input type="number" class="form-control border-left-0 border-right-0" value="{{ old('row') }}" id="row" name="row" max="100" min="0">
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
                <input type="checkbox" class="custom-control-input" id="defaultLocation" name="defaultLocation" value="1" checked>
                <label class="custom-control-label" for="defaultLocation">設為默認位置</label>
            </div>
        </div>

        <button type="submit" class="btn btn-secondary rounded-pill d-flex px-4 py-2 mx-auto mt-3">確定新增</button>
    </form>
</div>

@endsection