@extends('layouts.master') 
@section('title', '新增商品 | ') 
@section('content')

<div class="container">
    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="rounded bg-white shadow-sm mt-4 mx-n3 px-3 py-4">
            <h2 class="my-4 text-center">新增商品</h2>
            <h4 class="mb-4">
                <svg class="bi mx-2 mb-1" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#info-circle"/>
                </svg>商品基本資訊
            </h4>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="name">
                        名稱 <small class="text-danger">*必填</small>
                    </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="商品名稱">
                </div>
                <div class="form-group col-md-4">
                    <label for="category">
                        類型 <small class="text-danger">*必填</small>
                    </label>
                    <select class="custom-select" id="category" name="category">
                        <option value="">選擇類型</option>
                        @foreach ($categorys as $category)
                            <option value="{{ $loop->iteration }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="subname">
                    別名
                </label>
                <input type="text" class="form-control" id="subname" name="subname" placeholder="商品別名">
            </div>
        
            <hr class="my-4">
            <h4 class="mb-4">
                <svg class="bi mx-2 mb-1" width="20" height="20" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#diagram-3"/>
                </svg>子項資訊
            </h4>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="optionName">
                        子項名稱
                    </label>
                    <input type="text" class="form-control" id="optionName" name="optionName" placeholder="商品子項名稱">
                </div>
                <div class="form-group col-md-4">
                    <label for="image">
                        圖片
                    </label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
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
                            <span class="input-group-text px-3">$</span>
                        </div>
                        <input type="text" class="form-control" id="price" name="price" placeholder="每單位商品價格">
                    </div>
                </div>
                <div class="form-group col-4">
                    <label for="unit">
                        單位 <small class="text-danger">*必填</small>
                    </label>
                    <select class="custom-select" id="unit" name="unit">
                        <option value="">選擇單位</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultPrice" name="defaultPrice" value="1">
                <label class="custom-control-label" for="defaultPrice">設為默認價格</label>
            </div>
       
            <hr class="my-4">
            <h4 class="mb-4">
                <svg class="bi mx-2 mb-1" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#box-seam"/>
                </svg>位置資訊
            </h4>
            <div class="form-row">
                <div class="form-group col-6 col-md-3">
                    <label for="zone">
                        區域 <small class="text-danger">*必填</small>
                    </label>
                    <select class="custom-select" id="zone" name="zone">
                        <option value="">選擇區域</option>
                        @foreach ($zones as $zone)
                            <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6 col-md-3">
                    <label for="layer">
                        層
                    </label>
                    <select class="custom-select" id="layer" name="layer">
                        <option value="">選擇層</option>
                        <option value="1">上層</option>
                        <option value="2">中層</option>
                        <option value="3">下層</option>
                    </select>
                </div>
                <div class="form-group col-6 col-md-3">
                    <label for="col">
                        欄
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text px-3">
                                <svg class="bi my-1" width="16" height="16" fill="currentColor">
                                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#arrow-right-circle"/>
                                </svg>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="col" name="col" placeholder="">
                        <div class="input-group-append">
                            <span class="input-group-text px-3">欄</span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-6 col-md-3">
                    <label for="row">
                        列
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text px-3">
                                <svg class="bi my-1" width="16" height="16" fill="currentColor">
                                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#arrow-down-circle"/>
                                </svg>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="row" name="row" placeholder="">
                        <div class="input-group-append">
                            <span class="input-group-text px-3">列</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultLocation" name="defaultLocation" value="1">
                <label class="custom-control-label" for="defaultLocation">設為默認位置</label>
            </div>
        </div>

        <button type="submit" class="btn btn-secondary px-3 d-flex mx-auto mt-3">確定新增</button>
    </form>
</div>

@endsection