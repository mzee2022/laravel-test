const Login = () => import('@components/auth/login.vue')
const Home = () => import('@components/layout/Home.vue')
const Dashboard = () => import('@components/layout/Home.vue')

import auth from '@js/middleware/auth.js';

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
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            middleware: 'auth',
        },
    }
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
            return router.push({ name: 'login' });
        }
    } else if( to.meta.middleware == 'isLogged') {
        if (localStorage.getItem('token')) {
            next('/dashboard')
            // return router.push({ name: 'dashboard' });
        }
    }

    next();

});


export {
    router,
}
