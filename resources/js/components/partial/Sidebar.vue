<template>
    <div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">


        <!-- sidebar content -->
        <div class="flex flex-col">

            <!-- sidebar toggle -->
            <div class="text-right hidden md:block mb-4">
                <button id="sideBarHideBtn">
                    <i class="fad fa-times-circle"></i>
                </button>
            </div>
            <!-- end sidebar toggle -->

            <!-- link -->
            <router-link to="/dashboard" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500"> <i class="fad fa-chart-pie text-xs mr-2"></i> Dashboard</router-link>
            <!-- end link -->

            <!-- link -->
            <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-shield-check text-xs mr-2"></i>
                todo
            </a>
            <!-- end link -->

        </div>
        <!-- end sidebar content -->

    </div>
</template>

<script>
    export default {
        name: "Sidebar"
    }
</script>

<style scoped>

</style>