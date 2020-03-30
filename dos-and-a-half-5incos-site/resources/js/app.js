import Vue from 'vue';
import VueRouter from 'vue-router'

import store from './store';
import router from './router';

Vue.use(VueRouter)

new Vue({
    el: '#app',
    store,
    router
})

require('./bootstrap');
