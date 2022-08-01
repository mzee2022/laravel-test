<template>
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">

        <div class="grid grid-cols-1 pb-3">
            <form class="w-full" @submit.prevent="editTodo">
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Name
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input v-model="todo.name" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text">
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Description
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <textarea v-model="todo.description" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"></textarea>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3"></div>
                    <label class="md:w-2/3 block text-gray-500 font-bold">
                        <span class="text-sm">
                            Status
                        </span>
                        <input true-value="1" false-value="0" v-model="todo.status" class="mr-2 leading-tight" type="checkbox">
                    </label>
                </div>
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <router-link to="/todo/listing"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Back</router-link>
                        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</template>

<script>
    import { useRoute } from 'vue-router'
    import { mapActions , mapGetters} from 'vuex'


    export default {
        name: "Edit",
        data: () => {
            return {
                todo: {},
            }
        },
        created() {

            const route = useRoute();
            this.getTodoById(route.params.id)
        },
        computed:{
            ...mapGetters(['getTodo']),

            todo() {
                this.todo = this.getTodo;
                return this.todo;
            }
        },
        methods: {
            ...mapActions(['getTodoById','updateTodo']),

            editTodo() {
                this.updateTodo(this.todo)
            }
        }
    }
</script>

<style scoped>

</style>