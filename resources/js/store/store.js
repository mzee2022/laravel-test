import {createStore} from 'vuex'
import axios from 'axios'


const store = createStore({
    state: {
        users: [],
    },
    getters: {
        getUsers: (state) => state.users,
    },
    actions: {
        async loginUser({commit}, data) {
            let {email, password} = data
            try {
                let response = await axios.post(import.meta.env.VITE_APP_URL + 'api/login', {
                    email: email,
                    password: password
                });
                localStorage.setItem('token',response.data.data.token)
                // commit('SET_USERS', response.data.data)

                return response;

            } catch (error) {
                return error.response
            }
        }
    },
    mutations: {
        SET_USERS(state, users) {
            state.users = users
        }
    }
})

export {
    store,
}