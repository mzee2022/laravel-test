<template>
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">

        <div class="grid grid-cols-6 pb-3">
            <div class="col-start-7">
                <router-link to="/todo/create"
                             class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Todo
                </router-link>
            </div>

        </div>

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Description
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Status
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700"
                    v-for="todo in getTodos">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{todo.name}}
                    </th>
                    <td class="py-4 px-6">
                        {{todo.description}}
                    </td>
                    <td class="py-4 px-6">
                        {{todo.status ? 'Active' : 'In-active'}}
                    </td>
                    <td class="py-4 px-6">
                        <router-link :to="{ path: '/todo/'+ todo.id}"
                                     class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                        </router-link>
                        |
                        <button v-on:click="deleteTodo(todo.id)"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    import { mapActions , mapGetters} from 'vuex'

    export default {
        name: "list",
        created() {
            return this.fetchTodos();
        },
        computed: {
            ...mapGetters(['getTodoList']),
            getTodos() {
                return this.getTodoList
            }
        },
        methods: {
            ...mapActions(['deleteTodo','fetchTodos']),
            deleteTodo(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.deleteTodo(id)
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>