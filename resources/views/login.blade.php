@extends('layouts.master') 
@section('title', '登入 | ') 
@section('content')

<div class="container">
    @include('components/error')
    
    <div class="rounded bg-white shadow-sm mt-4 mx-n3 mx-sm-auto px-3 py-4" style="max-width: 600px;">
        <h2 class="mb-5 mt-3 text-center">登入</h2>

        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="username">
                    帳號 <small class="text-danger">*必填</small>
                </label>
                <input type="text" class="form-control" value="{{ old('username') }}" 
                id="username" name="username" placeholder="帳號" required>
            </div>
            <div class="form-group">
                <label for="password">
                    密碼 <small class="text-danger">*必填</small>
                </label>
                <input type="password" class="form-control" value="" 
                id="password" name="password" placeholder="密碼" required>
            </div>
            {{-- <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="remember" name="remember" value="1">
                <label class="custom-control-label" for="remember">記住我的帳號</label>
            </div> --}}
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-secondary rounded-pill px-4">登入</button>
            </div>
        </form>
    </div>
</div>

@endsection