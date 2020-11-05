<!DOCTYPE html>
<html lang="zh-TW">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  {{-- laravel csrf --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  
  <!-- Custom css -->
  <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
  <link href="{{ asset('css/img.css') }}" rel="stylesheet">

  <title>@yield('title')SBT順保堂</title>

</head>

<body>
    
  <div class="bg-light">
    @include('layouts/navbar')
    @yield('content')
    @include('layouts/footer')
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  {{-- vue.js --}}
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.21/dist/vue.js"></script>
  
  {{-- custom js --}}
  <script src="{{ asset('js/layout.js') }}"></script>
  <script src="{{ asset('js/productEditModal.js') }}"></script>

  @yield('script')

</body>

</html>