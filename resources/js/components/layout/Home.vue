<template>
    <section class="h-screen">
        <div class="container px-6 py-12 h-full">
            <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
                <div class="md:w-8/12 lg:w-6/12 mb-12 md:mb-0">
                    <img
                            src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                            class="w-full"
                            alt="Phone image"
                    />
                </div>
                <div class="md:w-8/12 lg:w-5/12 lg:ml-20">
                    <router-link class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" to="/login">Login</router-link>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "Home"
    }
</script>

<style scoped>

</style>