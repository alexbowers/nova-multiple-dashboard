Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'nova-multiple-dashboard',
            path: '/nova-multiple-dashboard',
            component: require('./components/Tool'),
        },
    ])
})
