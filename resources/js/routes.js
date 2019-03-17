import Vue from 'vue'
import VueRouter from 'vue-router'
import ExampleComponent from './components/ExampleComponent.vue';
import Topic from './components/Topic.vue';


Vue.use(VueRouter)

let routes = [
    {
        path: '/ejemplo',
        component: ExampleComponent
    },
    {
        path: '/temas',
        component: Topic
    },
];


export const router = new VueRouter({
    routes
});
