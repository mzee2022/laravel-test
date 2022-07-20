<template>
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="updateProfile">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="username" type="text" placeholder="Username" v-model="user.name">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Email
                </label>
                <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                       id="password" type="email" disabled v-model="user.email">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        name: "Profile",
        data: () => {
            return {
                user: {
                    name: localStorage.getItem('user_name'),
                    email: localStorage.getItem('user_email')
                }
            }
        },
        methods: {
            ...mapActions(['profileUpdate']),
            updateProfile() {
                this.profileUpdate(this.user)
            }

        }
    }
</script>
