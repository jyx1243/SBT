<template>
    <span>
        <i class="bi bi-box-seam mr-1"></i>{{ location.zone.name }}
        
        <template v-if="location.layer">{{ location.layer }}層</template>

        <template v-if="location.col">
            <i class="bi bi-arrow-right-circle mr-1"></i>{{ location.col }}
        </template>

        <template v-if="location.row">
            <i class="bi bi-arrow-down-circle mr-1"></i>{{ location.row }}
        </template>
    </span>
</template>

<script>
export default {
    props: {
        location: Object
    }
}
</script>
