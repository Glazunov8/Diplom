
require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
Vue.use(ElementUI);

import routes from "./routes";
const  router = new VueRouter({
    routes
});

import App from './App.vue';

new Vue({
    router,
    render: h => h(App)
}).$mount('#app');
