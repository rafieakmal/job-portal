<template>
    <section>
        <NavBar/>
        <Verify/>
        <MyFooter/>
    </section>
</template>

<style scoped>
.container {
    padding-top: 60px;
}

</style>
<script>
    import NavBar from '../components/public/Navbar.vue'
    import MyFooter from '../components/public/Footer.vue'
    import Verify from '../components/signup/Verify.vue';
    export default {
        metaInfo: {
            title: "MRI Job Portal - Verify My Account",
        },
        components: { NavBar, MyFooter, Verify },
        name: 'sign-up-page'
    }
</script>
