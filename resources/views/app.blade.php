<!DOCTYPE html>
<html lang="zh-TW">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <!-- Custom css -->
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/img.css') }}" rel="stylesheet">


    <title>SBT順保堂</title>

</head>

<body data-spy="scroll" data-target="#side-nav" data-offset="80">
    
    <div id="app" class="d-flex flex-column">
        <layout-navbar></layout-navbar>
        <!-- Vue Router 代入的內容 -->
        <router-view class="flex-grow-1"></router-view>
        <layout-footer></layout-footer>
    </div>

    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

</body>

</html>