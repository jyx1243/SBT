<!-- Navigation Start-->
<nav class="navbar sticky-top navbar-light bg-white shadow-sm">
    <div class="container p-0">
        <a class="navbar-brand mr-4 mb-0 order-1" href="{{ route('index') }}">SBT</a>

        <form method="GET" action="" class="form-inline mr-sm-3 mt-1 mt-sm-0 order-3 order-sm-2 col-12 col-sm-auto p-0">
            <div class="input-group">
                <input name="search" type="search" class="form-control search-input bg-light border-0" placeholder="搜尋...">
                <div class="input-group-append">
                    <button class="btn btn-dark search-btn px-0" type="submit">
                        <svg class="bi align-top" width="18" height="18" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#search"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>

        <a class="h6 mb-0 text-dark text-decoration-none ml-sm-auto order-2 order-sm-3" href="{{ route('product.index') }}">
            <svg class="bi" width="26" height="26" fill="currentColor">
                <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#person"/>
            </svg> 登入
        </a>
    </div>
</nav>
<!-- Navigation End  -->