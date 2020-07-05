import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/Home').default,
    },
    {
        path: '/user/:email',
        component: require('./components/AddressForm').default,
    },
];

export default new VueRouter({
    routes,

    linkActiveClass: 'is-active',
});
