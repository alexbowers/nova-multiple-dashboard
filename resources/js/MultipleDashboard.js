import Dashboard from './components/Dashboard';

Nova.booting((Vue, router) => {
    router.beforeEach((to, from, next) => {
        /**
         * Load the dashboard using our custom route.
         */
        if (to.name == 'dashboard' && to.path == '/') {
            next('/dashboards/main');
        }

        next();
    });

    router.addRoutes([
        {
            name: 'dashboard.custom',
            path: '/dashboards/:dashboardName',
            component: Dashboard,
            props: true,
        },
    ])
})
