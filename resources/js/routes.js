import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        name: 'users',
        component: require('./views/Home').default,
    },
    {
        path: '/user/:id',
        name: 'user',
        component: require('./components/User').default,
    },
];

export default new VueRouter({
    routes,

    linkActiveClass: 'is-active',
});
