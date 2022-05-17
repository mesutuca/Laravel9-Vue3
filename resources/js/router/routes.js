import API from "../services";

export default [
    {
        name: 'home',
        path: '/',
        component: () => import('../pages/Home'),
    },
    {
        name: 'categori',
        path: '/categoies',
        component: () => import('../pages/Categorie/List'),
        children: [
            {
                name: 'newcategori',
                path: 'newcategori',
                component: () => import('../pages/Categorie/Add'),
            }
        ]
    },
    {
        name: 'post',
        path: '/post',
        component: () => import('../pages/Post/List'),
    },
    {
        name: 'postdetail',
        path: '/post/:id',
        component: () => import('../pages/Post/Detail'),
        props: true
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