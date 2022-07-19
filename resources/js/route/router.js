const Login = () => import('@components/auth/login.vue')
const Home = () => import('@components/pages/Home.vue')
const Layout = () => import('@components/layout/Layout.vue')
const Dashboard = () => import('@components/pages/Dashboard.vue')


const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            middleware: 'isLogged',
        },
    },
    {
        path: '/',
        name: '',
        component: Layout,
        meta: {
            middleware: 'auth',
        },
        children: [
            {
                path: 'dashboard',
                name: 'dashboard',
                component: Dashboard,
            },
        ]
    },

]

import {createRouter, createWebHashHistory} from 'vue-router'

const router = createRouter({
    history: createWebHashHistory(),
    mode: "history",
    routes,
})

router.beforeEach((to, from, next) => {
    if (to.meta.middleware == 'auth') {
        if (!localStorage.getItem('token')) {
            return router.push({name: 'login'});
        }
    } else if (to.meta.middleware == 'isLogged') {
        if (localStorage.getItem('token')) {
            next('/dashboard')
        }
    }

    next();

});


export {
    router,
}
