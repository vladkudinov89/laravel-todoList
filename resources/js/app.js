/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import IndexComponent from "./components/IndexComponent";

require('./bootstrap');

window.Vue = require('vue');
import router from './router';
import store from './store/index';

// import VueRouter from 'vue-router';
//
// window.Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('index-component', require('./components/IndexComponent.vue'));
Vue.component('task-item', require('./components/TaskItem.vue'));

// const routes = [
//     {
//         path: '/',
//         components: {
//             indexComponent: IndexComponent
//         }
//     }
//     ];
//
// const router = new VueRouter({ routes })
//
// const app = new Vue({ router }).$mount('#app')

new Vue({
    el: '#app',
    router,
    store
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });
