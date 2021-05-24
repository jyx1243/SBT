<template>
    <nav class="navbar navbar-expand-md sticky-top navbar-light bg-white shadow-sm">
        <div class="container justify-content-sm-start">
            <router-link :to="{ name: 'index' }" class="navbar-brand">SBT</router-link>

            <form @submit.prevent="pushSearch" class="form-inline col col-sm-auto pl-0">
                <div class="input-group">
                    <input v-model="searchInput" type="search" class="form-control search-input bg-light border-0" placeholder="搜尋...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary search-btn px-0">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <button class="navbar-toggler border-0 p-0 ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav ml-auto">
                    <div class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle btn btn-link" id="navbarDropdown" type="button" data-toggle="dropdown">
                            <i class="bi bi-bag mr-2"></i>商品
                        </button>
                        <div class="dropdown-menu border-0 shadow-sm" style="min-width: 100px;">
                            <router-link :to="{ name: 'product.index' }" class="dropdown-item">全部</router-link>
                            <div class="dropdown-divider"></div>
                            <router-link v-for="category in categorys" :key="category.id" class="dropdown-item"
                                :to="{ name: 'product.index', query: { 'category[]': category.id }}">
                                {{ category.name }}
                            </router-link>
                        </div>
                    </div>

                    <!-- <a class="nav-item nav-link" href="{{ route('list.index') }}">
                        <i class="bi bi-clipboard mr-2"></i>清單
                        <span class="badge badge-pill badge-secondary @if (empty(session('list.options'))) d-none @endif" id="listOptionCount">
                            {{ count(session('list.options', array())) }}
                        </span>
                    </a>

                    {{-- 確認是否登入 --}}
                    @if (Auth::check())
                        <a class="nav-item nav-link" href="{{ route('logout') }}">
                            <i class="bi bi-person-fill mr-2"></i>登出
                        </a>
                    @else
                        <a class="nav-item nav-link" href="{{ route('login.index') }}">
                            <i class="bi bi-person mr-2"></i>登入
                        </a>
                    @endif -->
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                categorys: null,
                searchInput: '',
            }
        },
        created() {
            axios.get('/api/category')
            .then(response => {
                this.categorys = response.data
            })
        },
        watch: {
            $route(to, from) {
                this.hideCollapse()
            }
        },
        methods: {
            pushSearch() {
                this.$router.push({ name: 'product.index', query: { 'search': this.searchInput } })
            },
            hideCollapse() {
                $('.collapse').collapse('hide')
            }
        }
    }
</script>