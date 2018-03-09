import Vue from 'vue';
import axios from 'axios';
import Popper from 'popper.js';
import VueRouter from 'vue-router';


window.Vue = Vue;
Vue.use(VueRouter);

window.axios = axios;
window.Popper = Popper;


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;


// Global flash events
window.events = new Vue();
window.flashSuccess = function (message) {
    window.events.$emit('flash-success', message);
};
window.flashError = function (message) {
    window.events.$emit('flash-error', message);
};