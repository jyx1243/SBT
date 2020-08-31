@if (count($errors) > 0)
    <div class="alert alert-danger mt-4 mx-n3">
        <h4 class="text-center mt-2">錯誤訊息</h4>
        @foreach ($errors->all() as $error)
            <h6 class="mt-2">* {{ $error }}</h6>
        @endforeach
    </div>
@endif