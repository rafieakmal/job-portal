<template>
    <section>
        <NavBar/>
        <ForgotPassword/>
        <MyFooter/>
    </section>
</template>

<style scoped>
.container {
    padding-top: 60px;
}

</style>
<script>
    import ForgotPassword from '../components/signup/ForgotPassword.vue'
    import NavBar from '../components/public/Navbar.vue'
    import MyFooter from '../components/public/Footer.vue'
    export default {
        metaInfo: {
            title: "MRI Job Portal - Forgot Password",
        },
        components: { NavBar, MyFooter, ForgotPassword },
        name: 'forgot-password-page'
    }
</script>
