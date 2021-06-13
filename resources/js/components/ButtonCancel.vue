<template>
    <button @click.prevent="$emit('cancel')" class="btn btn-link text-secondary text-decoration-none px-0">
        <i class="bi bi-x h5 mb-0"></i>
        <slot class="ml-1"></slot>
    </button>
</template>

<script>
export default {
    props: {
        
    }
}
</script>