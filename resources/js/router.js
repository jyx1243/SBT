import Vue from 'vue';
import Router from 'vue-router';

// 引用頁面的 Component
import index from './pages/index.vue';
import productIndex from './pages/product/index.vue';

// 使用 Vue Router
Vue.use(Router);

// Route 設定
export const routes = [{ 
    path: '/',
    name: 'index',
    component: index
  },{
    path: '/product',
    name: 'product.index',
    component: productIndex
  },{
    path: '*',
    redirect: '/'
  }];

// 建立 Vue Router instance
const router = new Router({
  mode: 'history',
  routes
});

export default router;