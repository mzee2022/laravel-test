
import './bootstrap';

import { createApp } from 'vue'

import axios from 'axios';
axios.defaults.baseURL = import.meta.env.VITE_APP_URL;
axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
}


import app from './components/App.vue'
import swal from 'sweetalert2'

import { router } from './route/router'
import { store } from './store/store.js'

createApp(app).use(router, swal, store, axios).mount('#app');