<template>
    <section>
        <NavBar/>
        <Email :token="token" :accept-key="acceptKey"/>
        <MyFooter/>
    </section>
</template>

<style scoped>
.container {
    padding-top: 60px;
}

</style>
<script>
    // import ForgotPassword from '../components/signup/ForgotPassword.vue'
    // import Whatsapp from '../components/signup/Whatsapp.vue';
    import Email from '../components/signup/Email.vue';
    import NavBar from '../components/public/Navbar.vue'
    import MyFooter from '../components/public/Footer.vue'
    export default {
        metaInfo: {
            title: "MRI Job Portal - Whatsapp",
        },
        components: { NavBar, MyFooter, Email },
        name: 'email-verify-page',
        props: {
            token: String,
            acceptKey: String
        },
        created() {
            if (!this.token && !this.acceptKey) {
                this.$router.push('/verify-my-account')
            }
        }
    }
</script>
