import Vue from 'vue';
import store from './store';
import router from './router';
import VueRouter from "vue-router";

Vue.use(VueRouter);

new Vue({
    el: '#app',
    store,
    router
})

require('./bootstrap');
