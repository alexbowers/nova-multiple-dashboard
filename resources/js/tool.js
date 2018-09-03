import Dashboard from './components/Dashboard';


Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'dashboard.custom',
            path: '/dashboards/:dashboardName',
            component: Dashboard,
            props: true,
        },
    ])
})
