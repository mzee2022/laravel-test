<template>
    <div id="app-layout">
        <Header></Header>

        <div class="h-screen flex flex-row flex-wrap">
            <SideBar />
            <router-view></router-view>

        </div>
  </div>
</template>

<script>
    import SideBar from './../partial/Sidebar.vue'
    import Header from './../partial/Header.vue'
    export default {
        name: "Layout",
        components: {
            SideBar,
            Header
        }
    }
</script>

<style scoped>

</style>