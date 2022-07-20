import {createStore} from 'vuex'
import axios from 'axios'
import Swal from 'sweetalert2'
import {router} from '@js/route/router.js'

export default createStore({
    state: {
        todos: [],
        todo: {},
        userName: localStorage.getItem("user_name"),
    },
    getters: {
        getTodoList: (state) => {
            return state.todos;
        },
        getTodo: state => state.todo,
        getUserName: state => state.userName
    },
    actions: {
        async userLogin(context, user) {
            try {
                const {data} = await axios.post('api/login', user);
                if (data.status && typeof data.data != 'undefined') {
                    router.go('dashboard')
                    localStorage.setItem('token', data.data.accessToken)
                    localStorage.setItem('user_name', data.data.name)
                    localStorage.setItem('user_email', data.data.email)
                } else if (data.status) {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message,
                        icon: 'error',
                    })
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please enter correct email!',
                        icon: 'error',
                    })
                }

            } catch (error) {
                let displayError = '';
                error.data.forEach(error => {
                    displayError += error + '\n '
                })
                Swal.fire({
                    title: 'Error!',
                    html: "<pre>" + displayError + "</pre>",
                    icon: 'error',
                })
            }
        },
        async fetchTodos({commit}) {
            try {
                const {data} = await axios.get(import.meta.env.VITE_APP_URL + '/api/todo');
                commit("SET_TODO_LIST", data.data);

            } catch (error) {
                Swal.fire({
                    title: 'Error!',
                    html: "Something went wrong",
                    icon: 'error',
                })
            }
        },
        async addTodo(context, todo) {
            try {
                const {data} = await axios.post(import.meta.env.VITE_APP_URL + '/api/todo', todo);
                context.commit('ADD_TODO', data.data)
                Swal.fire({
                    title: 'Success!',
                    html: data.message,
                    icon: 'success',
                })
                router.push('/todo/listing')

            } catch (error) {
                let displayError = '';
                error.response.data.forEach(error => {
                    displayError += error + '\n'
                })
                if (displayError)
                    Swal.fire({
                        title: 'Error!',
                        html: "<pre>" + displayError + "</pre>",
                        icon: 'error',
                    })
            }
        },
        async getTodoById(context, id) {
            try {
                const {data} = await axios.get(import.meta.env.VITE_APP_URL + '/api/todo/' + id);
                if (data.status) {
                    context.commit('SINGLE_TODO', data.data)
                } else {
                    Swal.fire({
                        title: 'Error!',
                        html: "Record not found!",
                        icon: 'error',
                    });

                    router.push('/todo/listing')
                }

            } catch (error) {
                let displayError = '';
                error.response.data.forEach(error => {
                    displayError += error + '\n'
                })
                if (displayError)
                    Swal.fire({
                        title: 'Error!',
                        html: "<pre>" + displayError + "</pre>",
                        icon: 'error',
                    })
            }
        },
        async updateTodo(context, todo) {
            try {
                const {data} = await axios.put(import.meta.env.VITE_APP_URL + '/api/todo/' + todo.id, todo);
                if (data.status) {
                    context.commit("UPDATE_TODO", todo);
                    Swal.fire({
                        title: 'Success!',
                        html: data.message,
                        icon: 'success',
                    })
                    router.push('/todo/listing')
                }

            } catch (error) {
                let displayError = '';
                error.response.data.forEach(error => {
                    displayError += error + '\n'
                })
                if (displayError)
                    Swal.fire({
                        title: 'Error!',
                        html: "<pre>" + displayError + "</pre>",
                        icon: 'error',
                    })
            }

        },
        async deleteTodo(context, id) {
            try {
                const {data} = await axios.delete(import.meta.env.VITE_APP_URL + '/api/todo/' + id);
                if (data.status) {
                    context.commit("DELETE_TODO", id);
                    Swal.fire({
                        title: 'Success!',
                        html: data.message,
                        icon: 'success',
                    })
                } else {
                    Swal.fire({
                        title: 'Error!',
                        html: data.message,
                        icon: 'error',
                    })
                }

            } catch (error) {
                let displayError = '';
                error.response.data.forEach(error => {
                    displayError += error + '\n'
                })
                if (displayError)
                    Swal.fire({
                        title: 'Error!',
                        html: "<pre>" + displayError + "</pre>",
                        icon: 'error',
                    })
            }
        },
        async profileUpdate(context, user) {
            try {
                let { name } = user;
                await axios.post('api/update_profile', user);

                Swal.fire({
                    title: 'Success!',
                    text: 'Profile updated successfully',
                    icon: 'success',
                })
                localStorage.setItem('user_name', name);
                context.commit('SET_USER_NAME')

                router.push('/dashboard')
            } catch (errors) {
                Swal.fire({
                    title: 'Error!',
                    text: errors.response.data.name[0],
                    icon: 'error',
                })
            }
        },
        async logout() {
            let config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }
            try {
                const {data} = await axios.get('api/logout', config);
                localStorage.removeItem('token')
                localStorage.removeItem('user_name')
                localStorage.removeItem('user_email')
                router.go('login')
            } catch (error) {

                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong',
                    icon: 'error',
                })
            }
        }
    },
    mutations: {
        SET_TODO_LIST(state, todo) {
            state.todos = todo
        },
        ADD_TODO(state, todo) {
            state.todos.push(todo);
        },
        SINGLE_TODO(state, todo) {
            state.todo = todo
        },
        SET_USER_NAME(state) {
            state.userName = localStorage.getItem("user_name")
        },
        UPDATE_TODO(state, todo) {
            let index = state.todos.findIndex((c) => c.id == todo.id);
            if (index > -1) {
                state.todos[index] = todo;
            }
        },
        DELETE_TODO(state, id) {
            let index = state.todos.findIndex((c) => c.id == id);
            if (index > -1) {
                state.todos.splice(index, 1);
            }
        }
    }
})
