import Vue from 'vue'
import VueRouter from 'vue-router'
import ExampleComponent from './components/ExampleComponent.vue';
import Topic from './components/Topic.vue';
import Course from './components/Course.vue';



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
    {
        path: '/cursos',
        component: Course
    },
];


export const router = new VueRouter({
    routes
});
