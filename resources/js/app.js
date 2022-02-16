import Vue from 'vue';
import routes from './router/index';
import Toaster from 'v-toaster';
// You need a specific loader for CSS files like https://github.com/webpack/css-loader
import 'v-toaster/dist/v-toaster.css'
 
// optional set default imeout, the default is 10000 (10 seconds).
Vue.use(Toaster, {timeout: 5000})
require('./bootstrap');

//window.Vue = require('vue').default;



//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('app-header', require('./components/Header.vue').default);

const app = new Vue({
    el: '#app',
    router:routes,
});
