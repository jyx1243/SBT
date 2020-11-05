<template>
    <div class="container">
        <div class="d-flex flex-column flex-lg-row-reverse">
            <div class="d-flex flex-column flex-sm-row flex-lg-column mt-4 ml-lg-3" style="min-width: 250px;">
                <div class="dropdown col px-0 col-lg-auto">
                    <button class="dropdown-toggle btn btn-secondary shadow-sm col" type="button" 
                    id="orderDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        排列方式<span v-if="$route.query.order"> : {{ orders[orders.findIndex(i => i.string === $route.query.order)].title }}</span>
                    </button>
                    <div class="dropdown-menu col border-0 shadow-sm" aria-labelledby="orderDropdown">
                        <router-link v-for="order in orders" :key="order.title" class="dropdown-item"
                            :to="{ name: 'product.index', query: { order: order.string, search: $route.query.search, 'category[]': $route.query['category[]'] }}">
                            {{ order.title }}
                        </router-link>
                    </div>
                </div>

                <div class="dropdown col px-0 mt-2 mt-sm-0 ml-sm-2 d-lg-none">
                    <button class="dropdown-toggle btn btn-secondary shadow-sm col" type="button" 
                    id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        商品類別<span v-if="$route.query['category[]']"> ( 已選擇 {{ $route.query['category[]'].length }} 項 )</span>
                    </button>
                    <div class="dropdown-menu col border-0 shadow-sm" aria-labelledby="categoryDropdown">
                        <form @submit.prevent="pushCategory" class="px-3 py-1">
                            <div v-for="categoryCount in categoryCounts" :key="categoryCount.id" class="form-group custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" :id="categoryCount.id" name="category[]"
                                v-model="checkedCategorys" :value="categoryCount.id">
                                <label class="custom-control-label d-flex justify-content-between" :for="categoryCount.id">
                                    <span>{{ categoryCount.name }}</span>
                                    <span>( {{ categoryCount.options_count }} )</span>
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <button @click.prevent="clearCategory" class="btn btn-outline-secondary rounded-pill col mr-2">清除</button>
                                <button type="submit" class="btn btn-secondary rounded-pill col">篩選</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="bg-white border-0 shadow-sm d-none d-lg-block mt-3 p-3">
                    <h6 class="border-bottom pb-3 mb-3">
                        商品類別<span v-if="$route.query['category[]']"> ( 已選擇 {{ $route.query['category[]'].length }} 項 )</span>
                    </h6>
                    <form @submit.prevent="pushCategory">
                        <div v-for="categoryCount in categoryCounts" :key="categoryCount.id" class="form-group custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" :id="categoryCount.id" name="category[]"
                            v-model="checkedCategorys" :value="categoryCount.id">
                            <label class="custom-control-label d-flex justify-content-between" :for="categoryCount.id">
                                <span>{{ categoryCount.name }}</span>
                                <span>( {{ categoryCount.options_count }} )</span>
                            </label>
                        </div>
                        <div class="d-flex mt-3">
                            <button @click.prevent="clearCategory" class="btn btn-outline-secondary rounded-pill col mr-2">清除</button>
                            <button type="submit" class="btn btn-secondary rounded-pill col">篩選</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="rounded bg-white shadow-sm flex-lg-fill p-3 mt-2 mt-lg-4">
                <h4 v-if="$route.query.search" class="my-4 text-center">搜尋 "{{ $route.query.search }}" 的結果</h4>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">項目總計 {{ options.total }}</h6>
                    <!-- <router-link class="btn btn-outline-secondary rounded-pill flex-shrink-0" :to="{ name: 'product.create' }">
                        <svg class="bi align-top" width="22" height="22" fill="currentColor">
                            <use xlink:href="bootstrap-icons/bootstrap-icons.svg#plus"/>
                        </svg>  新增商品
                    </router-link> -->
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
    </div>
</template>

<script>
    export default {
        components: {
            'pagination': require('../../components/pagination.vue').default,
            'product-list': require('../../components/productList.vue').default
        },
        data() {
            return {
                options: {},
                categoryCounts: [],
                checkedCategorys: this.$route.query['category[]'] ? this.$route.query['category[]'] : [],
                categorys: [],
                orders: [
                    { string: 'id', title: 'ID (小至大)' },
                    { string: 'used', title: '最近觀看' },
                    { string: 'created', title: '最近新增' },
                    { string: 'category', title: '商品類型' },
                ]
            }
        },
        mounted() {
            this.getProduct()
        },
        watch: {
            $route(to, from) {
                this.getProduct()
            }
        },
        methods: {
            getProduct() {
                axios.get('/api/product', { params: this.$route.query })
                .then(response => {
                    this.options = response.data.options
                    this.categoryCounts = response.data.categoryCounts
                })
            },
            clearCategory() {
                this.checkedCategorys.splice(0)
                this.pushCategory()
            },
            pushCategory() {
                this.$router.push({ name: 'product.index', 
                    query: { 
                        order: this.$route.query.order, 
                        search: this.$route.query.search, 
                        'category[]': this.checkedCategorys 
                    }
                })
            }
        }
    }
</script>