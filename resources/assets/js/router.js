import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);

const Home = { render: h => h('h1', 'Home') };
import NotFound from './views/NotFound.vue';

export default new Router({
    mode: 'history',
    fallback: false,
    scrollBehavior: () => ({y: 0}),
    routes: [
        { path: '/', component: Home },
        { path: '*', component: NotFound }
    ]
});