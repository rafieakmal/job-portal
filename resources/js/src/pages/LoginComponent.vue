<template>
    <section>
        <NavBar/>
        <Login/>
        <MyFooter/>
    </section>
</template>

<style scoped>
.container {
    padding-top: 60px;
}

</style>
<script>
    import Login from '../components/signup/Login.vue'
    import NavBar from '../components/public/Navbar.vue'
    import MyFooter from '../components/public/Footer.vue'
    export default {
        metaInfo: {
            title: "MRI Job Portal - Login",
        },
        components: { NavBar, MyFooter, Login },
        name: 'sign-up-page'
    }
</script>
