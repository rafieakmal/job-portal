<template>
    <section>
        <NavBar/>
        <Contact/>
        <Faq/>
        <MyFooter/>
    </section>
</template>

<style scoped>
.container {
    padding-top: 60px;
}

</style>
<script>
    // import Login from '../components/signup/Login.vue'
    import Contact from '../components/public/Contact.vue'
    import Faq from '../components/public/Faq.vue'
    import NavBar from '../components/public/Navbar.vue'
    import MyFooter from '../components/public/Footer.vue'
    export default {
        metaInfo: {
            title: "MRI Job Portal - Contact",
        },
        components: { NavBar, MyFooter, Contact, Faq },
        name: 'contact-page'
    }
</script>