@if (session('status'))
    <div class="alert alert-warning mt-4 mx-n3">
        <span class="mt-2">{{ session('status') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif