<template>
    <div class="container">
        <!-- @include('components/error')
        @include('components/status') -->
        <loading-div v-if="loading"></loading-div>
        <form v-else @submit.prevent="putOption" enctype="multipart/form-data">
            <div class="rounded bg-white shadow-sm mt-4 p-3">
                <h2 class="my-4 text-center">修改 {{ option.product.name }}
                    <small class="text-muted"> {{ option.name }}</small>
                </h2>

                <h4 class="mb-3">
                    <svg class="bi mx-2 mb-1" width="18" height="18" fill="currentColor">
                        <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#info-circle"/>
                    </svg>基本資訊
                </h4>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="name">
                            名稱<small class="ml-1 text-danger">*必填<span class="ml-1 text-muted">最多10字</span></small>
                        </label>
                        <!-- @if ($errors->has('name')) is-invalid @endif -->
                        <input type="text" class="form-control"
                        v-model.trim="formData.product.name" id="name" placeholder="商品名稱" maxlength="10" required>
                        <div v-if="errors" class="invalid-feedback">
                            <h6 v-for="(error, index) in errors.name" :key="index">{{ $error }}</h6>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="category">
                            類型<small class="ml-1 text-danger">*必填</small>
                        </label>
                        <select class="custom-select" v-model="formData.product.category" id="category" required>
                            <option value="" disabled>選擇類型</option>
                            <option v-for="category in categorys" :key="category.id" :value="category.id">{{ category.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subname">
                        別名<small class="ml-1 text-muted">最多40字</small>
                    </label>
                    <input type="text" class="form-control" v-model.trim="formData.product.subname" id="subname" placeholder="商品別名" maxlength="40">
                    <small id="subnameHelp" class="form-text text-muted">
                        輸入所有可能的別名、諧音，以便更容易搜尋該商品
                    </small>
                </div>
            
                <hr class="my-4">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <svg class="bi mx-2 mb-1" width="20" height="20" fill="currentColor">
                            <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#diagram-3"/>
                        </svg>品項
                    </h4>
                    <router-link :to="{ name: 'product.createOption', params: { optionId: option.id }}" class="btn btn-outline-primary">
                        <svg class="bi align-top" width="22" height="22" fill="currentColor">
                            <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#plus"/>
                        </svg>  新增品項
                    </router-link>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="optionName">
                            品項名稱<small class="ml-1 text-muted">最多10字</small>
                        </label>
                        <input type="text" class="form-control" v-model.trim="formData.name" id="optionName" placeholder="商品品項名稱" maxlength="10">
                        <small id="subnameHelp" class="form-text text-muted">
                            多種有價格差異之品項屬於同一商品，輸入名稱以便區分各品項
                        </small>
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
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <svg class="bi mx-2" width="18" height="18" fill="currentColor">
                            <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#tag"/>
                        </svg>價格
                    </h4>
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createPriceModal">
                        <svg class="bi align-top" width="22" height="22" fill="currentColor">
                            <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#plus"/>
                        </svg>  新增價格
                    </button>
                </div>

                <div v-for="(price, index) in formData.prices" :key="price.id"> 
                    <div class="form-row justify-content-between align-items-center">
                        <div class="form-group col-auto order-1 mr-sm-3 mb-1 mb-md-3">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" :id="'defaultPrice'+index" :value="price.id" v-model="formData.default_price">
                                <label class="custom-control-label" :for="'defaultPrice'+index">
                                    <span class="h6">{{ price.unit.name }}</span> 設為默認
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-12 col-md order-3 order-md-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white pl-3 pr-1 border-right-0">
                                        <span class="border-right pr-3">$</span>
                                    </span>
                                </div>
                                <input type="number" class="form-control border-left-0 border-right-0" v-model="price.value" placeholder="每單位商品價格" min="0" required>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white pr-3 pl-1 border-left-0">
                                        <span class="border-left pl-3">{{ price.unit.name }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-auto order-2 order-md-3 mb-1 mb-md-3">
                            <!-- <button type="button" class="btn btn-link text-secondary pl-0" data-toggle="modal" data-target="#createSaleModal"
                            data-unit="{{ $price->unit->name }}" data-action="{{ route('sale.store', ['optionId' => $option->id, 'priceId' => $price->id]) }}">
                                <svg class="bi align-top" width="22" height="22" fill="currentColor">
                                    <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#plus"/>
                                </svg>新增優惠
                            </button>
                            <button type="button" class="btn btn-link text-danger pl-0" data-toggle="modal" data-target="#destroyModal"
                            data-title="刪除價格" data-action="{{ route('price.destroy', ['optionId' => $option->id, 'priceId' => $price->id]) }}">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#trash"/>
                                </svg> 刪除
                            </button> -->
                        </div>
                    </div>
                    <div v-for="(sale, index) in price.sales" :key="sale.id" class="form-row align-items-center bg-light rounded py-2 pl-2" :class="{'mt-n1': index == 0, 'mb-2': index == price.sales.length-1}">
                        <div class="form-group col-auto mb-0">
                            <h6><span class="badge badge-secondary">優惠</span></h6>
                        </div>
                        <div class="form-group col mb-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white pl-3 pr-1 border-right-0">
                                        <span class="border-right pr-3">$</span>
                                    </span>
                                </div>
                                <input type="number" class="form-control border-left-0" v-model="sale.value" placeholder="優惠價格" min="0" required>
                                <input type="number" class="form-control border-right-0 col-3" v-model="sale.quantity" placeholder="優惠數量" min="0" required>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white pr-3 pl-1 border-left-0">
                                        <span class="border-left pl-3">{{ price.unit.name }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-auto mb-0">
                            <!-- <button type="button" class="btn btn-link text-danger pl-0" data-toggle="modal" data-target="#destroyModal"
                            data-title="刪除優惠" data-action="{{ route('sale.destroy', ['optionId' => $option->id, 'priceId' => $price->id, 'saleId' => $sale->id]) }}">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#trash"/>
                                </svg> 刪除
                            </button> -->
                        </div>
                    </div>
                </div>
        
                <hr class="my-4">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <svg class="bi mx-2 mb-1" width="18" height="18" fill="currentColor">
                            <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#box-seam"/>
                        </svg>位置
                    </h4>
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createLocationModal">
                        <svg class="bi align-top" width="22" height="22" fill="currentColor">
                            <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#plus"/>
                        </svg>  新增位置
                    </button>
                </div>
                <div v-for="(location, index) in formData.locations" :key="location.id">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" :id="'defaultLocation'+index" :value="location.id" v-model="formData.default_location">
                            <label class="custom-control-label" :for="'defaultLocation'+index">
                                <span class="h6">位置 {{ index }}</span> 設為默認
                            </label>
                        </div>

                        <!-- <button type="button" class="btn btn-link text-danger" data-toggle="modal" data-target="#destroyModal" 
                        data-title="刪除位置 {{ $loop->iteration }}" data-action="{{ route('location.destroy', ['optionId' => $option->id, 'locationId' => $location->id]) }}">
                            <svg class="bi" width="18" height="18" fill="currentColor">
                                <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#trash"/>
                            </svg> 刪除
                        </button> -->
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6 col-md-3">
                            <select class="custom-select" v-model="location.zone_id" required>
                                <option value="" disabled>選擇區域</option>
                                <option v-for="zone in zones" :key="zone.id" :value="zone.id">{{ zone.name }}</option>
                            </select>
                        </div>
                        <div class="form-group col-6 col-md-3">
                            <select class="custom-select" v-model="location.layer">
                                <option value="" disabled>選擇層</option>
                                <option value="上">上層</option>
                                <option value="中">中層</option>
                                <option value="下">下層</option>
                            </select>
                        </div>
                        <div class="form-group col-6 col-md-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white pl-3 pr-1 border-right-0">
                                        <span class="border-right pr-3">
                                            <svg class="bi" width="18" height="18" fill="currentColor">
                                                <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#arrow-right-circle"/>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                                <input type="number" class="form-control border-left-0 border-right-0" v-model="location.col" max="100" min="0">
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
                                                <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#arrow-down-circle"/>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                                <input type="number" class="form-control border-left-0 border-right-0" v-model="location.row" max="100" min="0">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white pr-3 pl-1 border-left-0">
                                        <span class="border-left pl-3">列</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <svg class="bi mx-2 mb-1" width="18" height="18" fill="currentColor">
                            <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#journal"/>
                        </svg>配方
                    </h4>
                    <!-- <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createLocationModal">
                        <svg class="bi align-top" width="22" height="22" fill="currentColor">
                            <use xlink:href="/bootstrap-icons/bootstrap-icons.svg#plus"/>
                        </svg>  新增配方
                    </button> -->
                </div>
            </div>

            <button type="submit" class="btn btn-primary d-flex px-4 py-2 mx-auto mt-3">確定修改</button>
        </form>
    </div>

    <!-- <div class="modal fade" id="createPriceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">新增價格</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('price.store', $option->id) }}">
                        {{ csrf_field() }}
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
                                    <input type="number" class="form-control border-left-0" value="" id="price" name="price" placeholder="每單位商品價格" required>
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
                                                <option value="{{ $unit->id }}" @if ( $option->prices->contains('unit_id', $unit->id) ) disabled @endif>
                                                    {{ $unit->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultPrice" name="defaultPrice" value="1">
                            <label class="custom-control-label" for="defaultPrice">設為默認價格</label>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" class="btn btn-outline-primary rounded-pill px-4 mr-2" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-secondary rounded-pill px-4">新增</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createSaleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="modal-form" action="">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="sale">
                                    優惠價格 <small class="text-danger">*必填</small>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white pl-3 pr-1 border-right-0">
                                            <span class="border-right pr-3">$</span>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control border-left-0" value="" id="sale" name="sale" placeholder="商品優惠價格" required>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="quantity">
                                    優惠數量 <small class="text-danger">*必填</small>
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control border-right-0" value="" id="quantity" name="quantity" placeholder="商品優惠數量" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-white pr-3 pl-1 border-left-0">
                                            <span class="modal-unit border-left pl-3"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" class="btn btn-outline-primary rounded-pill px-4 mr-2" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-secondary rounded-pill px-4">新增</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                                <label for="zone">
                                    區域 <small class="text-danger">*必填</small>
                                </label>
                                <select class="custom-select" id="zone" name="zone" required>
                                    <option value="">選擇區域</option>
                                    @foreach (App\Models\Zone::all() as $zone)
                                        <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
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
                            <div class="form-group col-6">
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
                                    <input type="number" class="form-control border-left-0 border-right-0" value="" id="col" name="col" max="100" min="0">
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
                                    <input type="number" class="form-control border-left-0 border-right-0" value="" id="row" name="row" max="100" min="0">
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
                            <input type="checkbox" class="custom-control-input" id="defaultLocation" name="defaultLocation" value="1">
                            <label class="custom-control-label" for="defaultLocation">設為默認位置</label>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" class="btn btn-outline-primary rounded-pill px-4 mr-2" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-secondary rounded-pill px-4">新增</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script>
    export default {
        components: {
            'loading-div': require('../../components/loadingDiv.vue').default
        },
        data() {
            return {
                loading: true,
                errors: null,
                option: null,
                formData: null,
                categorys: null,
                zones: null
            }
        },
        created() {
            this.getOption()
            axios.get('/api/category')
            .then(response => {
                this.categorys = response.data
            })
            axios.get('/api/zone')
            .then(response => {
                this.zones = response.data
            })
        },
        watch: {
            $route(to, from) {
                this.getOption()
            }
        },
        methods: {
            getOption() {
                this.loading = true
                axios.get('/api/product/'+this.$route.params.optionId)
                .then(response => {
                    this.option = response.data
                    this.formData = {
                        product: {
                            name: response.data.product.name || '',
                            category: response.data.product.category_id || '',
                            subname: response.data.product.subname || ''
                        },
                        name: response.data.name || '',
                        image: response.data.image || '',
                        prices: response.data.prices || {},
                        default_price: response.data.default_price_id || '',
                        locations: response.data.locations || {},
                        default_location: response.data.default_location_id || '',
                        ingredient: response.data.ingredient || {}
                    }
                    this.loading = false
                })
            },
            putOption() {
                this.loading = true
                axios.put('/api/product/'+this.$route.params.optionId)
                .then(response => {
                    // this.option = response.data
                    this.loading = false
                })
            }
        }
    }
</script>