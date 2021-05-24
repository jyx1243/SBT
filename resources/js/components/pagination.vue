<template>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end my-3 p-0">
            <template v-if="results.current_page > 1">
                <li class="page-item">
                    <a @click="pushRouter(results.current_page - 1)" class="page-link border-0 bg-transparent text-body ml-2">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <li v-if="results.current_page > 2" class="page-item">
                    <a @click="pushRouter(1)" class="page-link border-0 shadow-sm rounded text-body ml-2">1</a>
                </li>
                
                <li v-if="results.current_page > 3" class="page-item ml-2">...</li>

                <li class="page-item">
                    <a @click="pushRouter(results.current_page - 1)" class="page-link border-0 shadow-sm rounded text-body ml-2">
                        {{ results.current_page-1 }}
                    </a>
                </li>
            </template>
            
            <li class="page-item disabled">
                <a class="page-link border-0 bg-transparent rounded text-body font-weight-bold ml-2">
                    {{ results.current_page }}
                </a>
            </li>
            
            <template v-if="results.current_page < results.last_page">
                <li class="page-item">
                    <a @click="pushRouter(results.current_page + 1)" class="page-link border-0 shadow-sm rounded text-body ml-2">
                        {{ results.current_page + 1 }}
                    </a>
                </li>

                <li v-if="results.current_page < results.last_page - 2" class="page-item ml-2">...</li>

                <li v-if="results.current_page < results.last_page - 1" class="page-item">
                    <a @click="pushRouter(results.last_page)" class="page-link border-0 shadow-sm rounded text-body ml-2">
                        {{ results.last_page }}
                    </a>
                </li>

                <li class="page-item">
                    <a @click="pushRouter(results.current_page + 1)" class="page-link border-0 bg-transparent text-body ml-2">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </template>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        results: Object
    },
    methods: {
        pushRouter(page) {
            this.$router.push({ name: 'product.index', 
                query: { 
                    search: this.$route.query.search,
                    order: this.$route.query.order, 
                    'category[]': this.$route.query['category[]'],
                    page: page
                }
            })
        }
    }
}
</script>