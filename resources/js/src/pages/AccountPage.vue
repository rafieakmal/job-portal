<template>
    <section>
        <NavBar />
        <Account />
        <MyFooter />
    </section>
</template>

<style scoped>
.container {
    padding-top: 60px;
}
</style>
<script>
import Account from '../components/settings/Account.vue'
import NavBar from '../components/public/Navbar.vue'
import MyFooter from '../components/public/Footer.vue'
export default {
    metaInfo: {
        title: "MRI Job Portal - Account Management",
    },
    components: { NavBar, MyFooter, Account },
    name: 'account-page'
}
</script>