
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'

Vue.use(VueRouter)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const routes = [
    { path: '/', components: {
        dashboard: require('./screens/Product.vue'),
        homepage: require('./screens/homepage/Product.vue')
    } },
    { path: '/product/:id', name: 'product', components: {
        homepage: require('./screens/homepage/ProductPage.vue')
    } },
    { path: '/category/:id', name: "category", components: {
        dashboard: require('./screens/Category.vue'),
        homepage: require('./screens/homepage/Category.vue')
    } },
    { path: '/category/', components: {
        dashboard: require('./screens/Category.vue'),
    } },
    { path: '/order', components: {
        dashboard: require('./screens/Order.vue')
    } }
];

const router = new VueRouter({
    routes
})
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('dashboard', require('./screens/Dashboard.vue'));
Vue.component('homepage', require('./screens/Homepage.vue'));
const app = new Vue({
    router
}).$mount('#app')
