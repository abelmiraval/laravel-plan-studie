/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import { router } from './routes'
import { store } from './store'


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('sidebar', require('./components/Sidebar.vue').default);
Vue.component('topic', require('./components/Topic.vue').default);
Vue.component('course', require('./components/Course.vue').default);
Vue.component('capacity', require('./components/Capacity.vue').default);
Vue.component('contentt', require('./components/Content.vue').default);








/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    router,
    store,
}).$mount('#app')
