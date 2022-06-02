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
        name: 'categoridetail',
        path: '/categoies/:id',
        component: () => import('../pages/Categorie/Detail'),
        props: true
    },
    {
        name: 'post',
        path: '/post',
        component: () => import('../pages/Post/List'),
        children: [
            {
                name: 'newpost',
                path: 'newpost',
                component: () => import('../pages/Post/Add'),
            }
        ]
    },
    {
        name: 'postdetail',
        path: '/post/:id',
        component: () => import('../pages/Post/Detail'),
        props: true
    },
    {
        name: 'postImage',
        path: '/post/:id/image',
        component: () => import('../pages/Post/Images')
    },
    {
        name: 'contact',
        path: '/contact',
        component: () => import('../pages/Contact'),

    },
    {
        name: 'contactm',
        path: '/contactm',
        component: () => import('../pages/Contact/List'),
        children: [
            {
                name: 'newcontact',
                path: 'newcontact',
                component: () => import('../pages/Contact/Add'),
            }
        ]
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