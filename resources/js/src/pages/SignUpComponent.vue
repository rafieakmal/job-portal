<template>
    <section>
        <NavBar/>
        <SignUp/>
        <MyFooter/>
    </section>
</template>

<style scoped>
.container {
    padding-top: 60px;
}

</style>
<script>
    import SignUp from '../components/signup/SignUp.vue'
    import NavBar from '../components/public/Navbar.vue'
    import MyFooter from '../components/public/Footer.vue'
    export default {
        metaInfo: {
            title: "MRI Job Portal - Sign Up",
        },
        components: { NavBar, MyFooter, SignUp },
        name: 'sign-up-page'
    }
</script>
