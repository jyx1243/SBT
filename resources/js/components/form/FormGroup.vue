<template>
    <div class="form-group">
        <label :for="id">
            {{ title }} <small class="text-primary" v-if="required">*必填</small>
        </label>

        <slot :id="id" :title="title" :required="required" :hasError="hasError"></slot>

        <small class="form-text text-muted">
            <slot name="help"></slot>
        </small>

        <error-feedback :errors="errors" v-if="errors"></error-feedback>
    </div>
</template>

<script>
import ErrorFeedback from './errorFeedback.vue'

export default {
    components: { 
        ErrorFeedback,
    },
    props: {
        id: String,
        title: String,
        required: Boolean,
        errors: Array
    },
    computed: {
        hasError() {
            return this.errors !== null
        }
    }
}
</script>