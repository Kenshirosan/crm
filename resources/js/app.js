require('./bootstrap');
import Vuex from 'vuex';
import store from './store';
import VueRouter from 'vue-router';
import router from './routes';
import moment from 'moment';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faUserSecret, faEnvelope, faAddressBook, faUser, faUserLock } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import filters from './filters';

library.add(faUserSecret, faEnvelope, faAddressBook, faUser, faUserLock);

window.Vue = require('vue');
Vue.use(VueRouter);
Vue.use(Vuex);

for(let f of filters) {
    Vue.filter(f.name, f.execute);
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.component('countries', require('./components/Countries.vue').default);
Vue.component('states', require('./components/States.vue').default);
Vue.component('cities', require('./components/Cities.vue').default);
Vue.component('flash', require('./components/Flash.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



const app = new Vue({
    el: '#app',
    router,
    store: new Vuex.Store(store),
});
