<!-- Navigation Start-->
<nav class="navbar navbar-expand-sm sticky-top navbar-light bg-white shadow-sm">
    <div class="container p-0">
        <a class="navbar-brand" href="{{ route('index') }}">SBT</a>

        <form method="GET" action="{{ route('product.index') }}" class="form-inline col col-sm-auto pl-0">
            <div class="input-group">
                <input name="search" type="search" class="form-control search-input bg-light border-0" placeholder="搜尋...">
                <div class="input-group-append">
                    <button class="btn btn-secondary search-btn px-0" type="submit">
                        <svg class="bi align-top" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#search"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>

        <button class="navbar-toggler border-0 p-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav ml-auto">
                <div class="nav-item dropdown">
                    <button class="nav-link dropdown-toggle btn btn-link text-dark text-decoration-none" id="navbarDropdown" 
                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="bi" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#bag"/>
                        </svg> 商品
                    </button>
                    <div class="dropdown-menu border-0 shadow-sm" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('product.index') }}">全部</a>
                        <div class="dropdown-divider"></div>
                        @foreach (App\Models\Category::all() as $category)
                            <a class="dropdown-item" href="{{ route('product.index') }}?category[]={{ $category->id }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>

                {{-- 確認是否登入 --}}
                @if (Auth::check())
                    <a class="nav-item nav-link" href="{{ route('logout') }}">
                        <svg class="bi" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#person-fill"/>
                        </svg> 登出
                    </a>
                @else
                    <a class="nav-item nav-link" href="{{ route('login.index') }}">
                        <svg class="bi" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{ asset('bootstrap-icons/bootstrap-icons.svg') }}#person"/>
                        </svg> 登入
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>
<!-- Navigation End  -->