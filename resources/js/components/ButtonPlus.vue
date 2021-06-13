<template>
    <button @click.prevent="$emit('plus')" class="btn btn-outline-primary">
        <i class="bi bi-plus h5 mb-0"></i>
        <slot class="ml-1"></slot>
    </button>
</template>

<script>
export default {
    props: {
        
    }
}
</script>