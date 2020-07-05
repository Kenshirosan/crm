require('./bootstrap');
import VueRouter from 'vue-router';
import router from './routes';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faUserSecret, faEnvelope, faAddressBook, faUser, faUserLock } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';


library.add(faUserSecret, faEnvelope, faAddressBook, faUser, faUserLock);

window.Vue = require('vue');
Vue.use(VueRouter);

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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
