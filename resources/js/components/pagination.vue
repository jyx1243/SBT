<template>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end my-3 p-0">
            <template v-if="results.current_page > 1">
                <li class="page-item">
                    <router-link :to="results.prev_page_url" class="page-link border-0 bg-transparent text-body ml-2">
                        <span aria-hidden="true">&laquo;</span>
                    </router-link>
                </li>

                <li v-if="results.current_page > 2" class="page-item">
                    <router-link :to="results.first_page_url" class="page-link border-0 shadow-sm rounded text-body ml-2">1</router-link>
                </li>
                
                <li v-if="results.current_page > 3" class="page-item ml-2">...</li>

                <li class="page-item">
                    <router-link :to="results.prev_page_url" class="page-link border-0 shadow-sm rounded text-body ml-2">
                        {{ results.current_page-1 }}
                    </router-link>
                </li>
            </template>
            
            <li class="page-item disabled">
                <a class="page-link border-0 bg-transparent rounded text-body font-weight-bold ml-2">
                    {{ results.current_page }}
                </a>
            </li>
            
            <template v-if="results.current_page < results.last_page">
                <li class="page-item">
                    <router-link :to="results.next_page_url" class="page-link border-0 shadow-sm rounded text-body ml-2">
                        {{ results.current_page + 1 }}
                    </router-link>
                </li>

                <li v-if="results.current_page < results.last_page - 2" class="page-item ml-2">...</li>

                <li v-if="results.current_page < results.last_page - 1" class="page-item">
                    <router-link :to="results.last_page_url" class="page-link border-0 shadow-sm rounded text-body ml-2">
                        {{ results.last_page }}
                    </router-link>
                </li>

                <li class="page-item">
                    <router-link :to="results.next_page_url" class="page-link border-0 bg-transparent text-body ml-2">
                        <span aria-hidden="true">&raquo;</span>
                    </router-link>
                </li>
            </template>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['results'],
    }
</script>