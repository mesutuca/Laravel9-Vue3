export default [
    {
        name: 'Home',
        path: '/',
        component: () => import('../pages/Home'),
    },
    {
        name: 'About',
        path: '/about',
        component: () => import('../pages/About')
    },
    {
        name: 'Contact',
        path: '/contact',
        component: () => import('../pages/Contact')
    },
    {
        name: 'Error',
        path: '/:pathMatch(.*)*',
        redirect: '/'
    }
]