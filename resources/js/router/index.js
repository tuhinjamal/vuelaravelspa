import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from '../components/Home.vue';
import CategoryList from '../components/category/index.vue';
import CategoryCreate from '../components/category/create.vue';
import CategoryEdit from '../components/category/edit.vue';
import ProductList from '../components/product/index.vue';
import ProductCreate from '../components/product/create.vue';
import ProductEdit from '../components/product/edit.vue';

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass:'active',
    routes: [
        {
            path:'/',
            component: Home,
            name:'home',

        },
        {
            path:'/category',
            component: CategoryList,
            name:'category-list',

        },
        {
            path:'/category/create',
            component: CategoryCreate,
            name:'category-create',

        },
        {
            path:'/category/edit/:id',
            component: CategoryEdit,
            name:'category-edit',

        },
        {
            path:'/product',
            component: ProductList,
            name:'product-list',

        },
        {
            path:'/product/create',
            component: ProductCreate,
            name:'product-create',

        },
        {
            path:'/product/edit/:id',
            component: ProductEdit,
            name:'product-edit',

        }
    ]
});

export default router;