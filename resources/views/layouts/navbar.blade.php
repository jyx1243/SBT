<!-- Navigation Start-->
<nav class="navbar sticky-top navbar-light bg-white shadow-sm">
    <div class="container p-0">
        <a class="navbar-brand mr-4 mb-0 order-1" href="{{ route('index') }}">SBT</a>

        <form method="GET" action="{{ route('product.search') }}" class="form-inline mr-sm-3 mt-1 mt-sm-0 order-3 order-sm-2 col-12 col-sm-auto p-0">
            <div class="input-group">
                <input name="search" type="search" class="form-control search-input bg-light border-0" placeholder="搜尋...">
                <div class="input-group-append">
                    <button class="btn btn-secondary search-btn px-0" type="submit">
                        <svg class="bi align-top" width="18" height="18" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#search"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>

        <div class="d-flex align-items-center ml-sm-auto order-2 order-sm-3">
            <a class="text-dark text-decoration-none" href="{{ route('product.index') }}?page=1">
                <svg class="bi" width="18" height="18" fill="currentColor">
                    <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#bag"/>
                </svg> 商品
            </a>

            {{-- 確認是否登入 --}}
            @if (Auth::check())
                <a class="text-dark text-decoration-none ml-3" href="{{ route('logout') }}">
                    <svg class="bi" width="22" height="22" fill="currentColor">
                        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#person-fill"/>
                    </svg> 登出
                </a>
            @else
                <a class="text-dark text-decoration-none ml-3" href="{{ route('login.index') }}">
                    <svg class="bi" width="22" height="22" fill="currentColor">
                        <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#person"/>
                    </svg> 登入
                </a>
            @endif
        </div>
    </div>
</nav>
<!-- Navigation End  -->