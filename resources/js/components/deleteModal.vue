<template>
    <div class="modal fade" id="destroyModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle mr-2"></i>刪除 {{ name }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center mt-4 mb-5">刪除後將無法復原，是否確定刪除?</h6>

                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-dark flex-fill" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-danger flex-fill ml-2" @click="deleteOption">刪除</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
 
 <script>
export default {
    props: {
        name: String,
        id: Number
    },
    methods: {
        deleteOption() {
            $('#destroyModal').modal('hide')

            axios.delete('/api/product/'+this.id)
            .then(response => {
                // this.option = response.data
                this.$router.push({ name: 'product.index' })
            })
        }
    }
}
</script>