<template>
    <section>
        <NavBar/>
        <Home/>
        <MyFooter/>
    </section>
</template>

<script>
    import Home from '../components/home/Home.vue'
    import NavBar from '../components/public/Navbar.vue'
    import MyFooter from '../components/public/Footer.vue'
    export default {
        metaInfo: {
            title: "MRI Job Portal - Home",
        },
        components: { NavBar, MyFooter, Home },
        name: 'vote-form',
        data() {
            return {
                user: {},
                isLoggedIn: false,
                isUser: false,
            }
        },
        created () {
            this.setUser()
        },
        methods: {
            setUser() {
                this.user = this.$cookies.get('user')
                this.isLoggedIn = this.$cookies.get('token') != null
                if(this.user && this.isLoggedIn) {
                    if(this.user.role != "admin") {
                        this.$router.push('/')
                        this.isUser = true
                    } else {
                        this.isUser = false
                    }
                } else {
                    this.$router.push('/login')
                }
            },
        }
    }
</script>
