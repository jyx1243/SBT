<template>
    <span>
        <span class="h5">$</span>
        <span class="h4">{{ price.value }}</span>
        <span> / {{ price.unit.name }}</span>
    </span>
</template>

<script>
export default {
    props: {
        price: Object
    }
}
</script>