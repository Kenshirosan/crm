require('./bootstrap');
import Vuex from 'vuex';
import store from './store';
import VueRouter from 'vue-router';
import router from './routes';
import { library } from '@fortawesome/fontawesome-svg-core';
import {
    faUserSecret,
    faEnvelope,
    faAddressBook,
    faUser,
    faUserLock,
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import filters from './filters';

library.add(faUserSecret, faEnvelope, faAddressBook, faUser, faUserLock);

window.Vue = require('vue');
Vue.use(VueRouter);
Vue.use(Vuex);

// register filters in Vue instance
for (let f of filters) {
    Vue.filter(f.name, f.execute);
}

//TODO Vue.config.errorHandler
//TODO await this.$nextTick() in AddressForm
//TODO: stuff in file on1 sublime on laptop

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.component('countries', require('./components/Countries.vue').default);
Vue.component('states', require('./components/States.vue').default);
Vue.component('cities', require('./components/Cities.vue').default);
Vue.component('flash', require('./components/Flash.vue').default);

const app = new Vue({
    el: '#app',
    router,
    store: new Vuex.Store(store),
});
