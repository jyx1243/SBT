<template>
    <div class="container">
        <div class="text-center my-5">
            <h1 class="display-1 mb-0">SBT</h1>
            <h2>順保堂中藥房</h2>
        </div>
        <div class="rounded bg-white shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0">最近觀看的商品</h6>
                <router-link :to="{ name: 'product.index', query: { order: 'used' }}" class="btn btn-outline-primary px-3">
                    查看全部
                </router-link>
            </div>

            <div class="d-flex flex-wrap mx-n3">
                <div v-for="option in options" :key="option.id" class="col-6 col-sm-4 col-lg-2 mt-3 px-3">
                    <product-card :option="option"></product-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        components: {
            'product-card': require('../components/productCard.vue').default
        },
        data() {
            return {
                options: null,
            }
        },
        created() {
            axios.get('/api/product', { params: { order: 'used'}})
            .then(response => {
                this.options = response.data.options.data
            })
            .catch(error => {
                console.log(error)
            })
        }
    }
</script>