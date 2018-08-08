
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// Vue.use(require('vue-moment'));
import VueMoment from 'vue-moment';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';


Vue.use(VueRouter);
Vue.use(VueResource);
Vue.use(VueMoment);

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//Navigartion Bar Added

Vue.component('app', require('./components/App.vue'));
Vue.component('navbar', require('./components/Navbar.vue'));
Vue.component('queries', require('./components/Queries.vue'));
Vue.component('contacts', require('./components/Contacts.vue'));

import App from './components/App';
import Queries from './components/Queries';
import Contacts from './components/Contacts';
import Home from './components/Home';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/queries',
            name: 'queries',
            component: Queries
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: Contacts,
        },
    ],
});


const app = new Vue({
    el: '#app',
    components: {App},
    router,
});
