<template>
    <small class="text-danger form-text">
        <p v-for="(error, errorIndex) in errors" :key="errorIndex">{{ error }}</p>
    </small>
</template>

<script>
export default {
    props: {
        errors: Array
    }
}
</script>