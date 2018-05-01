import './bootstrap';
import router from './routes';

Vue.component('flash', require('./components/Flash'));

const app = new Vue({
    el: '#app',

    router: router,

    data: {
        showMenu: true
    },

    methods: {
        toggleMenu() {
            this.showMenu = !this.showMenu;
        }
    }
});
