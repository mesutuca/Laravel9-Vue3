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
        name: 'ImageEdit',
        path: '/slider/:id',
        component: () => import('../pages/Slider/Edit'),
        props: true
    },
    {
        name: 'contact',
        path: '/contact',
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
        name: 'contactform',
        path: '/contactform',
        component: () => import('../pages/Contact/Form'),
    },
    {
        name: 'contactdetail',
        path: '/contact/:id',
        component: () => import('../pages/Contact/Detail'),
        props: true
    },
    {
        name: 'deneme',
        path: '/deneme',
        component: () => import('../pages/Deneme')
    },
    {
        name: 'rulet',
        path: '/rulet',
        component: () => import('../pages/rulet')
    },
    {
        name: 'error',
        path: '/:pathMatch(.*)*',
        redirect: '/'
    }
]