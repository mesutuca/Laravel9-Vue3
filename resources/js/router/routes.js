export default [
    {
        name: 'Home',
        path: '/',
        component: () => import('../pages/Home'),
    },
    {
        name: 'Post',
        path: '/Post',
        component: () => import('../pages/Post'),
        children: [
            {
                path: '',
                component: () => import('../pages/ImageDetail'),
            }
        ]
    },
    {
        name: 'Contact',
        path: '/contact',
        component: () => import('../pages/Contact')
    },
    {
        name: 'Deneme',
        path: '/Deneme',
        component: () => import('../pages/Deneme')
    },
    {
        name: 'Error',
        path: '/:pathMatch(.*)*',
        redirect: '/'
    }
]