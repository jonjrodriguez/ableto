import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);

import Home from './views/Home.vue';
import Survey from './views/Survey.vue';
import ViewSurvey from "./views/ViewSurvey.vue";
import NotFound from './views/NotFound.vue';

export default new Router({
    mode: 'history',
    fallback: false,
    scrollBehavior: () => ({y: 0}),
    routes: [
        { path: '/', component: Home },
        { path: '/survey', component: Survey },
        { path: '/survey/:date', component: ViewSurvey, props: true },
        { path: '*', component: NotFound }
    ]
});