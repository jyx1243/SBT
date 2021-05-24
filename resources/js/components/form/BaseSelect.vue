<template>
    <select class="custom-select" :class="{ 'is-invalid': hasError }"
    :value="value" @change="$emit('change', $event.target.value)">
        <option value="" disabled>選擇{{ title }}</option>
        <option v-for="option in options" :key="option.id" :value="option.id" :disabled="hasDisabled(option.id)">{{ option.name }}</option>
    </select>
</template>

<script>
export default {
    model: {
        prop: 'value',
        event: 'change'
    },
    props: {
        value: String,
        title: String,
        options: Array,
        disableds: Array,
        hasError: Boolean
    },
    methods: {
        hasDisabled(id) {
            return this.disableds && this.disableds.indexOf(id) !== -1
        }
    }
}
</script>