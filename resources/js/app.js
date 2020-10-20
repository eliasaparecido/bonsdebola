require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

Vue.component('jogadores', require('./components/jogadores.vue').default);

const app = new Vue({
    el: '#app'
});