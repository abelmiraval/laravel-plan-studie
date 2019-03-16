import Vue from 'vue'
import VueRouter from 'vue-router'
import ExampleComponent from './components/ExampleComponent.vue';

Vue.use(VueRouter)

let routes = [
    {
        path: '/example',
        component: ExampleComponent
    },
];


export const router = new VueRouter({
    routes
});
