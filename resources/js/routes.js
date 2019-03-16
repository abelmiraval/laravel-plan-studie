import Vue from 'vue'
import VueRouter from 'vue-router'
import ExampleComponent from './components/ExampleComponent.vue';

Vue.use(VueRouter)

let routes = [
    {
        path: '/temas',
        component: ExampleComponent
    },
];


export const router = new VueRouter({
    routes
});
