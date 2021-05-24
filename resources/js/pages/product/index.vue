<template>
    <div class="container">
        <loading-div v-if="loading"></loading-div>
        <template v-else>
            <div class="d-flex flex-column flex-lg-row-reverse">
                <div class="d-flex flex-column flex-sm-row flex-lg-column mt-3 ml-lg-3" style="min-width: 250px;">
                    <div class="col col-lg-auto px-0 rounded shadow-sm bg-secondary">
                        <button class="btn btn-secondary btn-block py-2 d-flex justify-content-between align-items-center"
                        type="button" data-toggle="collapse" data-target="#orderCollapse">
                            <span>
                                排列方式<span v-if="$route.query.order"> : {{ orders.find(i => i.string === $route.query.order).title }}</span>
                            </span>
                            <i class="bi bi-caret-down"></i>
                        </button>
                        <div class="collapse d-lg-block" id="orderCollapse">
                            <div class="bg-white rounded mx-1 mb-1 p-2">
                                <router-link v-for="order in orders" :key="order.string" class="custom-control custom-radio text-body mb-2"
                                :to="{ name: 'product.index', query: { order: order.string, search: $route.query.search, 'category[]': $route.query['category[]'] }}">
                                    <input class="custom-control-input" type="radio" :id="order.string" :value="order.string" v-model="pickedOrder">
                                    <label class="custom-control-label" :for="order.string">{{ order.title }}</label>
                                </router-link>
                            </div>
                        </div>
                    </div>

                    <div class="col col-lg-auto px-0 rounded shadow-sm bg-secondary mt-2 mt-sm-0 mt-lg-3 ml-sm-2 ml-lg-0">
                        <button class="btn btn-secondary btn-block py-2 d-flex justify-content-between align-items-center"
                        type="button" data-toggle="collapse" data-target="#categoryCollapse">
                            <span>
                                商品類別<span v-if="$route.query['category[]'] && $route.query['category[]'].length > 0"> : 已選擇 {{ $route.query['category[]'].length }} 項</span>
                            </span>
                            <i class="bi bi-caret-down"></i>
                        </button>
                        <div class="collapse d-lg-block" id="categoryCollapse">
                            <div class="bg-white rounded mx-1 mb-1 p-2">
                                <div v-for="categoryCount in categoryCounts" :key="categoryCount.id" class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" :id="categoryCount.id"
                                    v-model="checkedCategorys" :value="categoryCount.id">
                                    <label class="custom-control-label d-flex justify-content-between" :for="categoryCount.id">
                                        <span>{{ categoryCount.name }}</span>
                                        <span>( {{ categoryCount.options_count }} )</span>
                                    </label>
                                </div>
                                <button @click="clearCategory" class="btn btn-outline-secondary btn-block mt-3">清除篩選</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded bg-white shadow-sm flex-lg-fill p-3 mt-2 mt-lg-3">
                    <h4 v-if="$route.query.search" class="my-4 text-center">搜尋 "{{ $route.query.search }}" 的結果</h4>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">項目總計 {{ options.total }}</h6>
                        <router-link class="btn btn-outline-primary" :to="{ name: 'product.create' }">
                            <i class="bi bi-plus h5 mb-0 mr-1"></i>新增商品
                        </router-link>
                    </div>

                    <div v-if="options.data.length > 0">
                        <product-list v-for="option in options.data" :key="option.id" :option="option"></product-list>
                    </div>

                    <div v-else class="rounded bg-light py-5">
                        <h6 class="text-center mb-0">無任何項目</h6>
                    </div>
                </div>
            </div>

            <pagination :results="options"></pagination>
        </template>
    </div>
</template>

<script>
    export default {
        // props: ['search', 'order', 'category'],
        components: {
            'loading-div': require('../../components/loadingDiv.vue').default,
            'pagination': require('../../components/pagination.vue').default,
            'product-list': require('../../components/productList.vue').default
        },
        created() {
            this.getOptions()
        },
        data() {
            return {
                loading: true,
                options: null,
                categoryCounts: null,
                checkedCategorys: this.$route.query['category[]'] ? Array.from(this.$route.query['category[]']) : [],
                pickedOrder: this.$route.query.order || '',
                orders: [
                    { string: 'id', title: 'ID (小至大)' },
                    { string: 'used', title: '最近觀看' },
                    { string: 'created', title: '最近新增' },
                    { string: 'category', title: '商品類型' },
                ]
            }
        },
        watch: {
            $route(to, from) {
                this.getOptions()
                if (this.checkedCategorys.toString() !== [to.query['category[]']].toString()) {
                    this.checkedCategorys = [to.query['category[]']]
                }
                this.pickedOrder = this.$route.query.order || ''
            },
            checkedCategorys(newVal, oldVal) {
                if (newVal.toString() !== [this.$route.query['category[]']].toString()) {
                    this.pushRouter()
                }
            }
        },
        methods: {
            getOptions() {
                this.loading = true
                axios.get('/api/product', { params: this.$route.query })
                .then(response => {
                    this.options = response.data.options
                    this.categoryCounts = response.data.categoryCounts
                    this.loading = false
                })
            },
            clearCategory() {
                this.checkedCategorys.splice(0)
            },
            pushRouter() {
                this.$router.push({ name: 'product.index', 
                    query: { 
                        search: this.$route.query.search,
                        order: this.$route.query.order, 
                        'category[]': this.checkedCategorys 
                    }
                })
            }
        }
    }
</script>