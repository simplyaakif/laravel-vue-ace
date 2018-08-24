

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

import { VueMaskDirective } from 'v-mask'
Vue.directive('mask', VueMaskDirective);


Vue.component('app', require('./components/App.vue'));
Vue.component('navbar', require('./components/Navbar.vue'));
Vue.component('queries', require('./components/Queries.vue'));
Vue.component('contacts', require('./components/Contacts.vue'));
Vue.component('admissions', require('./components/Admissions.vue'));
Vue.component('sms', require('./components/Sms.vue'));

import App from './components/App';
import Queries from './components/Queries';
import Contacts from './components/Contacts';
import Home from './components/Home';
import Admissions from './components/Admissions';
import Sms from './components/Sms';
import Courses from './components/Courses';
import Expenses from './components/Expenses';

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
        {
            path: '/admissions',
            name: 'admissions',
            component: Admissions,
        },
        {
            path: '/sms',
            name: 'sms',
            component: Sms,
        },
        {
            path: '/courses',
            name: 'courses',
            component: Courses,
        },
        {
            path: '/expenses',
            name: 'expenses',
            component: Expenses,
        },
    ],
});


const app = new Vue({
    el: '#app',
    components: {App},
    router,
});
