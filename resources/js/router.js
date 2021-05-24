import Vue from 'vue';
import Router from 'vue-router';

// 引用頁面的 Component
import index from './pages/index.vue';
import product_index from './pages/product/index.vue';
import product_create from './pages/product/create.vue';
import product_show from './pages/product/show.vue';
import product_edit from './pages/product/edit.vue';

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
    component: product_index
  },{
    path: '/product/create',
    name: 'product.create',
    component: product_create
  },{
    path: '/product/:optionId',
    name: 'product.show',
    component: product_show
  },{
    path: '/product/:optionId/edit',
    name: 'product.edit',
    component: product_edit
  },{
    path: '*',
    redirect: '/'
}];

// 建立 Vue Router instance
const router = new Router({
  mode: 'history',
  routes,
  scrollBehavior(to, from, savedPosition) {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        if (savedPosition) {
          resolve(savedPosition)
        } else if (to.hash) {
          resolve({ selector: to.hash, offset: { x: 0, y: 70 }, behavior: 'smooth'})
        } else {
          resolve({ x: 0, y: 0 })
        }
      }, 300)
    })
  }
});

export default router;