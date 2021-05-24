<template>
    <div class="bg-light rounded shadow-sm mt-3 py-2">
        <div class="d-flex justify-content-between align-items-center mx-3">
            <slot name="title"></slot>
        </div>
        <div class="form-row bg-white rounded mx-2 mt-2 px-2 pt-2">
            <slot name="content"></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        
    }
}
</script>