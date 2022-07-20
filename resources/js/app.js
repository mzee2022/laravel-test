
import './bootstrap';

import { createApp } from 'vue'

import axios from 'axios';
axios.defaults.baseURL = import.meta.env.VITE_APP_URL;
axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
}


import App from './components/App.vue'
import Swal from 'sweetalert2'

import { router } from './route/router'
import store from './store/store'
import Vuex from 'vuex'


const app = createApp(App)
app.use(store)
app.use(router, Swal, axios, Vuex)
app.mount('#app');

// createApp(app).use(router, swal, store, axios).mount('#app');