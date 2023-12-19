<template>
    <div class="container-xl">
            <div class="row pt-3">
                <div class="col-md-7 text-center text-md-start mx-auto">
                    <div class="text-center">
                        <h1 class="display-4 fw-bold mb-5">Welcome to MRI job&nbsp;<span class="underline">portal</span>.</h1>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mx-auto">
                    <div class="text-center position-relative"><img class="img-fluid" src="assets/img/illustrations/13850246_5386608.svg" style="width: 800px;"></div>
                </div>
            </div>
        </div>
</template>

<script>
    import { EventBus } from '../../eventBus.js'
    import verifyUser from '../../verifyUser'
    export default {
        name: "onboarding",
        metaInfo: {
            title: "MRI Job Portal - Onboarding",
        },
        data() {
            return {
                timer: 5,
                interval: null
            }
        },
        props: {
            token: String,
            candidate: String
        },
        mounted() {
            window.addEventListener("beforeunload", this.emitTimerEnd());
        },
        beforeDestroy() {
            clearInterval(this.interval)
        },
        methods: {
            goToLogin() {
                this.$router.push({ name: 'login' })
            },
            goToSignUp() {
                this.$router.push({ name: 'sign-up' })
            },
            async emitTimerEnd() {
                let originWindow = window.location.origin
                this.$cookies.set('id', this.candidate, '1d')
                this.$cookies.set('user_token', this.token, '1d')

                let user = await verifyUser(this.candidate)
                let addStore = this.$store.commit('addUser', user)

                EventBus.$emit('loggedIn')
                this.$router.push('/')
            },
            async countdownStart() {
                this.interval = setInterval(() => {
                    this.timer--
                    if (this.timer === 0) {
                        clearInterval(this.interval)
                        this.emitTimerEnd()
                    }
                }, 1000)
                
            },
        }
    }
</script>