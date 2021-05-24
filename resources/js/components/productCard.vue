<template>
    <div>
        <router-link :to="{ name: 'product.show', params: { optionId: option.id }}" class="text-decoration-none">
            <div class="img-square">
                <img class="img-cover" :src="'/img/product/' + option.image">
            </div>

            <h5 class="text-body mt-3">
                {{ option.product.name }}
                <span v-if="option.name" class="h6">/ {{ option.name }}</span>
            </h5>
        </router-link>

        <router-link v-if="option.default_price" class="d-block text-body text-decoration-none"
            :to="{ name: 'product.show', params: { optionId: option.id }, hash: '#price'}">
            <price-span :price="option.default_price"></price-span>
        </router-link>

        <router-link v-if="option.default_location" class="btn btn-light btn-sm bg-white shadow-sm mt-1"
            :to="{ name: 'product.show', params: { optionId: option.id }, hash: '#location'}">
            <location-span :location="option.default_location"></location-span>
        </router-link>
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
