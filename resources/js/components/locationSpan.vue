<template>
    <span>
        <svg class="bi mx-1 mb-1" width="16" height="16" fill="currentColor">
            <use xlink:href="bootstrap-icons/bootstrap-icons.svg#box-seam"/>
        </svg>
        {{ location.zone.name }}
        
        <template v-if="location.layer">{{ location.layer }}層</template>

        <template v-if="location.col">
            <svg class="bi mb-1" width="16" height="16" fill="currentColor">
                <use xlink:href="bootstrap-icons/bootstrap-icons.svg#arrow-right-circle"/>
            </svg>
            {{ location.col }}
        </template>

        <template v-if="location.row">
            <svg class="bi mb-1" width="16" height="16" fill="currentColor">
                <use xlink:href="bootstrap-icons/bootstrap-icons.svg#arrow-down-circle"/>
            </svg>
            {{ location.row }}
        </template>
    </span>
</template>

<script>
    export default {
        props: ['location']
    }
</script>
