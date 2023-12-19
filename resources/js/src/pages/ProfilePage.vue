<template>
    <section>
        <NavBar/>
        <Profile/>
        <MyFooter/>
    </section>
</template>

<style scoped>
.container {
    padding-top: 60px;
}

</style>
<script>
    import Profile from '../components/settings/Profile.vue'
    import NavBar from '../components/public/Navbar.vue'
    import MyFooter from '../components/public/Footer.vue'
    export default {
        metaInfo: {
            title: "MRI Job Portal - Profile",
        },
        components: { NavBar, MyFooter, Profile },
        name: 'profile-page'
    }
</script>