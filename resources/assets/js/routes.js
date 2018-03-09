import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/Home')
    },
    {
        path: '/output',
        component: require('./views/List')
    },
    {
        path: '/output/create',
        component: require('./views/Create')
    },
    {
        name: 'edit',
        path: '/output/:id/edit',
        component: require('./views/Edit')
    }
];

export default new VueRouter({
    routes
});