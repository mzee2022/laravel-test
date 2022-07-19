<template>
    <div class="md:fixed md:w-full md:top-0 md:z-20 flex flex-row flex-wrap items-center bg-white p-6 border-b border-gray-300">

        <!-- logo -->
        <div class="flex-none w-56 flex flex-row items-center">
            <strong class="capitalize ml-1 flex-1">Laravel Test</strong>

            <button id="sliderBtn" class="flex-none text-right text-gray-900 hidden md:block">
                <i class="fad fa-list-ul"></i>
            </button>
        </div>
        <!-- end logo -->

        <!-- navbar content toggle -->
        <button id="navbarToggle" class="hidden md:block md:fixed right-0 mr-6">
            <i class="fad fa-chevron-double-down"></i>
        </button>
        <!-- end navbar content toggle -->

        <!-- navbar content -->
        <div id="navbar" class="animated md:hidden md:fixed md:top-0 md:w-full md:left-0 md:mt-16 md:border-t md:border-b md:border-gray-200 md:p-10 md:bg-white flex-1 pl-3 flex flex-row flex-wrap justify-between items-center md:flex-col md:items-center">
            <!-- left -->
            <div class="text-gray-600 md:w-full md:flex md:flex-row md:justify-evenly md:pb-10 md:mb-10 md:border-b md:border-gray-200">
            </div>
            <!-- end left -->

            <!-- right -->
            <div class="flex flex-row-reverse items-center">

                <!-- user -->
                <div class="dropdown relative md:static">

                    <div class="">

                        <div class="dropdown inline-block relative">
                            <button class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center">
                                <span class="mr-1" v-html="user_name"></span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                            </button>
                            <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                                <li class="">
                                    <router-link to="/profile" class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap">Profile</router-link>
                                </li>
                                <li class=""><button class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" @click="userLogout">Logout</button></li>
                            </ul>
                        </div>

                    </div>

                </div>
                <!-- end user -->
            </div>
            <!-- end right -->
        </div>

    </div>
</template>

<script>
    import { router } from '@js/route/router.js'
    import axios from 'axios'

    export default {
        name: "Header",
        data: () => {
            return{
                user_name : localStorage.getItem('user_name')
            }
        },

        methods: {
            userLogout() {
                let config = {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    }
                }
                try {
                    axios.get('api/logout', config)
                        .then(function (response) {
                            if (response.status && typeof response.data.data != 'undefined') {

                                router.go('login')

                                localStorage.removeItem('token')
                                localStorage.removeItem('user_name')
                                localStorage.removeItem('user_email')

                            } else if (response.status) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.data.message,
                                    icon: 'error',
                                })
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Please enter correct email!',
                                    icon: 'error',
                                })
                            }

                        })
                        .catch(function (error) {
                        })
                        .finally(() => this.loading = false)

                } catch (error) {
                }
            }
        }
    }
</script>

<style scoped>
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>