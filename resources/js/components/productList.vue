<template>
    <div class="border-top pt-3 mt-3">
        <div class="d-flex">
            <router-link :to="{ name: 'product.show', params: { optionId: option.id }}">
                <img class="img-product-index" :src="'/img/product/' + option.image">
            </router-link>
            
            <div class="d-flex flex-column flex-fill justify-content-start justify-content-sm-between ml-2 ml-sm-3">
                <div class="d-flex justify-content-between">
                    <router-link :to="{ name: 'product.show', params: { optionId: option.id }}" class="h4 text-body">
                        {{ option.product.name }}
                        <span v-if="option.name" class="h5">/ {{ option.name }}</span>
                    </router-link>
                    <h4>
                        <router-link :to="{ name: 'product.index', query: { 'category[]': option.product.category.id }}" class="badge badge-info">
                            {{ option.product.category.name }}
                        </router-link>
                    </h4>
                </div>

                <h6 class="text-muted">{{ option.product.subname }}</h6>

                <div class="d-none d-sm-block">
                    <span v-for="price in option.prices.slice(0, 2)" :key="price.id">
                        <price-span :price="price"></price-span>

                        <span v-for="sale in price.sales" :key="sale.id">
                            <span class="badge badge-secondary ml-1">
                                優惠 ${{ sale.value }} / {{ sale.quantity }}{{ price.unit.name }}
                            </span>
                        </span>

                        <span> , </span>
                    </span>
                    <router-link :to="{ name: 'product.show', params: { optionId: option.id }, hash: '#price'}" class="text-body">更多價格</router-link>
                </div>

                <div class="d-none d-sm-flex align-items-center">
                    <router-link v-if="option.default_location" :to="{ name: 'product.show', params: { optionId: option.id }, hash: '#location'}" class="btn btn-light bg-white p-1 shadow-sm">
                        <location-span :location="option.default_location"></location-span>
                    </router-link>

                    <!-- 判斷商品是否有在清單裡 -->
                    <!-- <button type="button" class="btn btn-primary rounded-pill ml-auto @if (!in_array($option->id, array_column(session('list.options', array()), 'optionId'))) d-none @endif">
                        <i class="bi bi-trash mr-2"></i>
                        <span class="d-none d-md-inline"> 移除</span>
                    </button>

                    <button type="button" class="btn btn-outline-primary rounded-pill ml-auto @if (in_array($option->id, array_column(session('list.options', array()), 'optionId'))) d-none @endif">
                        <i class="bi bi-clipboard mr-2"></i>
                        <span class="d-none d-md-inline"> 清單</span>
                    </button>
                    
                    <router-link :to="{ name: 'product.edit', params: { optionId: option.id }}" class="btn btn-outline-primary rounded-pill ml-2">
                        <i class="bi bi-pencil-square mr-2"></i>
                        <span class="d-none d-md-inline"> 修改</span>
                    </router-link> -->
                </div>
            </div>
        </div>

        <div class="d-block d-sm-none mt-1">
            <span v-for="price in option.prices.slice(0, 2)" :key="price.id">
                <price-span :price="price"></price-span>

                <span v-for="sale in price.sales" :key="sale.id">
                    <span class="badge badge-secondary ml-1">
                        優惠 ${{ sale.value }} / {{ sale.quantity }}{{ price.unit.name }}
                    </span>
                </span>

                <span> , </span>
            </span>
            <router-link :to="{ name: 'product.show', params: { optionId: option.id }, hash: '#price'}" class="text-body">更多價格</router-link>
        </div>

        <div class="d-flex d-sm-none align-items-center mt-1">
            <router-link v-if="option.default_location" :to="{ name: 'product.show', params: { optionId: option.id }, hash: '#location'}" class="btn btn-light bg-white p-1 shadow-sm">
                <location-span :location="option.default_location"></location-span>
            </router-link>

            <!-- 判斷商品是否有在清單裡 -->
            <!-- <button type="button" class="btn btn-secondary rounded-pill ml-auto @if (!in_array($option->id, array_column(session('list.options', array()), 'optionId'))) d-none @endif">
                <i class="bi bi-trash mr-2"></i>
                <span class="d-none d-md-inline"> 移除</span>
            </button>

            <button type="button" class="btn btn-outline-primary rounded-pill ml-auto @if (in_array($option->id, array_column(session('list.options', array()), 'optionId'))) d-none @endif">
                <i class="bi bi-clipboard mr-2"></i>
                <span class="d-none d-md-inline"> 清單</span>
            </button>
            
            <router-link :to="{ name: 'product.edit', params: { optionId: option.id }}" class="btn btn-outline-primary rounded-pill ml-2">
                <i class="bi bi-pencil-square mr-2"></i>
                <span class="d-none d-md-inline"> 修改</span>
            </router-link> -->
        </div>
    </div>
</template>

<script>
import LocationSpan from './locationSpan.vue'
import PriceSpan from './priceSpan.vue'

export default {
    props: {
        option: Object
    },
    components: {
        LocationSpan,
        PriceSpan
    },
}
</script>
