<template>
    <div class="container">
        <loading-div v-if="loading"></loading-div>
        <template v-else>
            <div class="rounded bg-white shadow-sm mt-3 p-3">
                <div class="d-flex flex-column flex-md-row">
                    <div class="col-md-6 px-0">
                        <div class="img-square">
                            <img class="img-contain" :src="'/img/product/' + option.image">
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-fill ml-md-5 mt-3 mt-md-0">
                        <h4>
                            <router-link :to="{ name: 'product.index', query: { 'category[]': option.product.category.id }}" class="badge badge-info">
                                {{ option.product.category.name }}
                            </router-link>
                        </h4>
                        <h4>
                            {{ option.product.name }}
                            <span v-if="option.name" class="h5">/ {{ option.name }}</span>
                        </h4>

                        <h6 class="text-muted">{{ option.product.subname }}</h6>

                        <div v-if="option.default_price" class="mt-2">
                            <small>價格：</small>
                            <price-span :price="option.default_price"></price-span>
                        </div>

                        <div v-if="option.default_location" class="mt-2">
                            <small>位置：</small>
                            <location-span :location="option.default_location"></location-span>
                        </div>

                        <div v-if="option.product.options.length > 1" class="dropdown">
                            <button class="dropdown-toggle btn btn-link btn-block text-body border-top rounded-0 mt-3 pt-2" type="button" 
                                id="otherDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                其他品項 ( {{ option.product.options.length }} )
                            </button>
                            <div class="dropdown-menu col border-0 shadow-sm" aria-labelledby="otherDropdown">
                                <router-link v-for="otherOption in option.product.options" :key="otherOption.id"
                                    :to="{ name: 'product.show', params: { optionId: otherOption.id }}" class="dropdown-item d-flex align-items-center">
                                    <img :src="'/img/product/' + otherOption.image" style="width: 50px; height: 50px; object-fit: cover;">
                                    <h6 class="ml-2 mb-0">{{ otherOption.product.name }} {{ otherOption.name }}</h6>
                                    <span class="ml-auto">
                                        <price-span :price="otherOption.default_price"></price-span>
                                    </span>
                                </router-link>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-lg-row mt-2">
                            <router-link :to="{ name: 'product.edit', params: { optionId: option.id }}" class="btn btn-outline-primary mr-0 mr-lg-2 flex-fill">
                                <i class="bi bi-pencil-square mr-2"></i>修改
                            </router-link>

                            <button type="button" class="btn btn-outline-danger mt-2 mt-lg-0 flex-fill" data-toggle="modal" data-target="#destroyModal">
                                <i class="bi bi-trash mr-2"></i>刪除
                            </button>

                            <delete-modal :name="option.product.name + (option.name ? ' / '+ option.name : '')" :id="option.id"></delete-modal>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column flex-md-row">
                <div id="price" class="rounded bg-white shadow-sm mt-4 p-3 col mr-0 mr-md-4">
                    <h5 class="mb-3">
                        <i class="bi bi-tag mr-2"></i>價格
                    </h5>
                    <div v-for="price in option.prices" :key="price.id" class="border-top pt-2 mt-2">
                        <price-span :price="price"></price-span>
                        
                        <span v-for="sale in price.sales" :key="sale.id" class="badge badge-secondary ml-1 align-baseline">
                            <span class="h6">
                                優惠 ${{ sale.value }} / {{ sale.quantity }}{{ price.unit.name }}
                            </span>                             
                        </span>
                    </div>
                </div>

                <div id="location" class="rounded bg-white shadow-sm mt-4 p-3 col">
                    <h5 class="mb-3">
                        <i class="bi bi-box-seam mr-2"></i>位置
                    </h5>
                    <div v-for="location in option.locations" :key="location.id" class="border-top pt-2 mt-2">
                        <location-span :location="location"></location-span>
                    </div>
                </div>
            </div>

            <div id="ingredient" v-if="option.ingredient" class="rounded bg-white shadow-sm mt-4 p-3">
                <h5 class="mb-3">
                    <i class="bi bi-journal mr-2"></i>配方
                    <small class="text-muted"> | 項目總計 {{ option.ingredient.options.length }}</small>
                </h5>
                <h6>說明：{{ option.ingredient.description }}</h6>

                <div class="d-flex flex-wrap mx-n3">
                    <div v-for="iOption in option.ingredient.options" :key="iOption.id" class="col-12 col-sm-6 col-lg-4 d-flex justify-content-between mt-2">
                        <router-link :to="{ name: 'product.show', params: { optionId: iOption.id }}" class="h5 text-body">
                            {{ iOption.product.name }}
                            <span v-if="iOption.name" class="small"> / {{ iOption.name }}</span>
                        </router-link>
                        <h5>
                            {{ iOption.pivot.quantity+' '+iOption.pivot.unit.name }}
                        </h5>
                    </div>
                </div>
            </div>

            <div v-if="option.product.options.length > 1" class="rounded bg-white shadow-sm mt-4 p-3">
                <h5>
                    <i class="bi bi-diagram-3 mr-2"></i>其他品項
                    <small class="text-muted"> | 項目總計 {{ option.product.options.length }}</small>
                </h5>
                <div class="d-flex flex-wrap mx-n3">
                    <div v-for="otherOption in option.product.options" :key="otherOption.id" class="col-6 col-md-4 col-lg-3 mt-3">
                        <product-card :option="otherOption"></product-card>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        components: {
            'loading-div': require('../../components/loadingDiv.vue').default,
            'location-span': require('../../components/locationSpan.vue').default,
            'price-span': require('../../components/priceSpan.vue').default,
            'product-card': require('../../components/productCard.vue').default,
            'delete-modal': require('../../components/deleteModal.vue').default
        },
        data() {
            return {
                loading: true,
                option: null,
            }
        },
        created() {
            this.getOption()
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
                    this.loading = false
                })
            }
        }
    }
</script>
