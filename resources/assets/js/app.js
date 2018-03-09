import './bootstrap';
import router from './routes';

Vue.component('flash', require('./components/Flash'));

const app = new Vue({
    el: '#app',

    router: router
});
