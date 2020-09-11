<div class="modal fade" id="destroyLocationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="modal-text text-center mt-3 mb-4"></h6>

                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4 mr-2" data-dismiss="modal">取消</button>
                    <form method="POST" class="destroy-form" action="">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger rounded-pill px-4">刪除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>