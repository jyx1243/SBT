<template>
    <div class="input-group">
        <div class="input-group-prepend" v-if="prepend">
            <span class="input-group-text bg-white px-0" :class="{ 'border-danger': hasError }">
                <span class="border-right px-3">
                    <slot name="prepend">
                        {{ prepend }}
                    </slot>
                </span>
            </span>
        </div>
        <input v-bind="$attrs" class="form-control" :class="{ 'is-invalid': hasError, 'border-left-0': prepend, 'border-right-0': append }" 
        :value="value" @input="$emit('input', $event.target.value)" :maxlength="maxlength" :placeholder="defaultPlaceholder">
        <div class="input-group-append" v-if="append">
            <span class="input-group-text bg-white px-0" :class="{ 'border-danger': hasError }">
                <span class="border-left px-3">
                    <slot name="append">
                        {{ maxlength ? maxlengthAppend : append }}
                    </slot>
                </span>
            </span>
        </div>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        value: [String, Number],
        prepend: [Boolean, String],
        append: [Boolean, String],
        title: String,
        placeholder: String,
        hasError: Boolean,
        maxlength: Number
    },
    computed: {
        defaultPlaceholder() {
            if (this.placeholder) {
                return this.placeholder
            } else if (this.title) {
                return '輸入' + this.title
            } else {
                return ''
            }
        },
        maxlengthAppend() {
            return this.value.length + ' / ' + this.maxlength
        }
    }
}
</script>