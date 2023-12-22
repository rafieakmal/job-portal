<template>
    <div>
        <NavBar/>
        <router-view></router-view>
        <MyFooter/>
    </div>
</template>

<script>
    import NavBar from '../components/public/Navbar.vue'
    import MyFooter from '../components/public/Footer.vue'
    export default {
        metaInfo: {
        title: 'MRI Job Portal - Edit Profile',
        },
        components: { NavBar, MyFooter },
        name: 'edit-profile-page',
    }
</script>
