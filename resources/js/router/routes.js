export default [
    {
        name: 'home',
        path: '/',
        component: () => import('../pages/Home'),
    },
    {
        name: 'post:id',
        path: '/post',
        component: () => import('../pages/Post'),
        children: [
            {
                path: ':id',
                name:'postdetail',
                component: () => import('../pages/ImageDetail'),
            }
        ]
    },
    {
        name: 'contact',
        path: '/contact',
        component: () => import('../pages/Contact')
    },
    {
        name: 'deneme',
        path: '/deneme',
        component: () => import('../pages/Deneme')
    },
    {
        name: 'error',
        path: '/:pathMatch(.*)*',
        redirect: '/'
    }
]