const Login = () => import('@components/auth/login.vue')
const Home = () => import('@components/pages/Home.vue')
const Layout = () => import('@components/layout/Layout.vue')
const Dashboard = () => import('@components/pages/Dashboard.vue')
const Profile = () => import('@components/pages/Profile.vue')
const TodoListing = () => import('@components/pages/todo/List.vue')
const AddTodo = () => import('@components/pages/todo/Add.vue')
const EditTodo = () => import('@components/pages/todo/Edit.vue')

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
            {
                path: 'profile',
                name: 'profile',
                component: Profile,
            },
            {
                path: 'todo/listing',
                name: 'todoListing',
                component: TodoListing,
            },
            {
                path: 'todo/create',
                name: 'createTodo',
                component: AddTodo,
            },
            {
                path: 'todo/:id',
                name: 'editTodo',
                component: EditTodo,
            },
        ]
    },

]

import {createRouter, createWebHashHistory} from 'vue-router'

const router = createRouter({
    history: createWebHashHistory(),
    mode: "history",
    linkActiveClass: "text-blue-700",
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
