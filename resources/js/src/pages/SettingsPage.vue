<template>
    <section>
        <NavBar/>
        <Settings/>
        <MyFooter/>
    </section>
</template>

<style scoped>
.container {
    padding-top: 60px;
}

</style>
<script>
    import Settings from '../components/settings/Settings.vue'
    import NavBar from '../components/public/Navbar.vue'
    import MyFooter from '../components/public/Footer.vue'
    export default {
        metaInfo: {
            title: "MRI Job Portal - Settings",
        },
        components: { NavBar, MyFooter, Settings },
        name: 'settings-page'
    }
</script>