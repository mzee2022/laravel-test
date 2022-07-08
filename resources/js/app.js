
import './bootstrap';

import { createApp } from 'vue'


import app from './components/App.vue'


const Login = () => import('@components/auth/login.vue')
const Home = () => import('@components/layout/Home.vue')

const routes = [
    {
        path: '/' , component: Home,
    },
    {
        path: '/login' , component: Login,
    }
]

import { createRouter , createWebHashHistory} from 'vue-router'

const router = createRouter({
    history: createWebHashHistory(),
    mode: "history",
    routes,
})


createApp(app).use(router).mount('#app');