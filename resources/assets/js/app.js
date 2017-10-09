import Vue from 'vue';
import App from './App.vue';
import router from './router'

Vue.component('App', App);

new Vue({
    el: '#app',
    router
});