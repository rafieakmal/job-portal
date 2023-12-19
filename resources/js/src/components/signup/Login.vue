<template>
    <section class="py-4 py-md-5 my-5">
        <div class="container-xl py-md-5">
            <div class="row">
                <div class="col-md-6 text-center" id="img-heading">
                    <img class="img-fluid w-100" src="assets/img/illustrations/20824344_6343823.svg">
                </div>
                <div class="col text-start text-md-start">
                    <h2 class="display-6 fw-semibold mb-5">
                        <span class="underline pb-1">
                            Login
                        </span>
                    </h2>
                    <form @submit.prevent="loginForm">
                        <div class="mb-3">
                            <input v-model="email" class="shadow form-control" type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input v-model="password" v-show="!showPassword" class="shadow form-control" type="password" name="password" placeholder="Password" minlength="8" required>
                            <input v-model="password" v-show="showPassword" class="shadow form-control" type="text" name="password" placeholder="Password" minlength="8" required>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input v-model="showPassword" class="form-check-input" type="checkbox" value="true" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Show Password
                                </label>
                            </div>
                        </div>
                        <div v-if="!isVerified" >
                            <vue-recaptcha ref="recaptcha" sitekey="6LfVTC4pAAAAAOBdUZZO-hNtoTaeQtlHYfjI7vZP" 
                                @verify="verifyMethod"
                                @expired="expiredMethod"
                                @render="renderMethod"
                                @error="errorMethod"
                            
                            ></vue-recaptcha>
                        </div>
                        <div v-if="error">
                            <p style="color: red;">{{ error }}</p>
                        </div>
                        <div class="text-center mb-5">
                            <div v-if="!isLoading">
                                <button v-if="isVerified" class="btn btn-primary shadow" type="submit" style="width: 100%;">Log in</button>
                            </div>

                            <div v-else>
                                <button class="btn btn-primary shadow" type="button" style="width: 100%;">
                                    <b-spinner small label="Spinning"></b-spinner> Loading...
                                </button>
                            </div>
                            
                            
                            <div class="divider d-flex align-items-center my-4">
                                <p class="text-center mx-3 mb-0">or</p>
                            </div>
                            <button class="btn btn-light fw-lighter shadow" type="button" @click="loginGoogle" style="width: 100%;">
                                <img src="assets/img/pngwing.com.png" style="margin-right: 10px;margin-top: 0px;margin-bottom: 2px;max-height: 100%;max-width: 3%;">
                                Log in Using Google
                            </button>
                        </div>
                    </form>
                    <p class="text-muted"><a href="/forgot-password">Forgot your password?</a></p>
                </div>
            </div>
        </div>
    </section>
</template>

<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }

    .hidden {
        display: none;
    }

    @media (max-width: 991px) {
        #img-heading {
            display: none;
        }
    }
</style>

<script>
    import { VueRecaptcha } from 'vue-recaptcha';
    import verifyUser from '../../verifyUser.js'
    export default {
        metaInfo: {
            title: "MRI Job Portal - Login",
        },
        components: { VueRecaptcha },
        data() {
            return {
                email: '',
                password: '',
                error: null,
                showPassword: false,
                message: '',
                isVerified: false,
                isLoading: false,
                newWindow: null
            }
        },
        methods: {
            onEvent() {
                // when you need a reCAPTCHA challenge
                this.$refs.recaptcha.execute();
            },

            verifyMethod(response) {
                this.isVerified = true
            },
            expiredMethod() {
                this.isVerified = false
            },
            renderMethod() {
                // yellow console log
                console.log('%c[ System ]: Google Recaptcha Rendered', 'background-color: green; font-size: larger');
            },
            errorMethod(error) {
                this.isVerified = false
                console.log(`Error: ${error}`)
            },
            async onMessage (e) {
                if (e.origin !== window.origin || !e.data.token) {
                  return
                }
                var data = e.data
                this.$cookies.set('id', data.id, '7d')
                this.$cookies.set('user_token', data.token, '7d')

                let user = await verifyUser(data.id)
                let addStore = this.$store.commit('addUser', user)

                
                this.$emit('loggedIn')
                this.$router.push('/')
            },
            async loginForm() {
                this.isLoading = true
                await axios.post('/api/candidate/login', {
                    email: this.email,
                    password: this.password
                })
                .then(response => {
                    this.isLoading = false
                    let data = response.data
                    if (data.error || data.status === 401) {
                        this.error = data.error
                        return
                    }

                    this.$cookies.set('id', data.user_id, '1d')
                    this.$cookies.set('user_token', data.token, '1d')

                    this.$emit('loggedIn')
                    this.$router.push('/')
                })
                .catch(error => {
                    console.log(error)
                    this.isLoading = false
                    this.error = "Email or password do not match. Please try again";
                });
            },

            async loginGoogle() {
                const { data } = await axios.post('/api/google-redirect')
                return window.location.href = data.url
            },

            openWindow (url, title, options = {}) {
                if (typeof url === 'object') {
                    options = url
                    url = ''
                }

                options = { url, title, width: 600, height: 720, ...options }

                const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screen.left
                const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screen.top
                const width = window.innerWidth || document.documentElement.clientWidth || window.screen.width
                const height = window.innerHeight || document.documentElement.clientHeight || window.screen.height

                options.left = ((width / 2) - (options.width / 2)) + dualScreenLeft
                options.top = ((height / 2) - (options.height / 2)) + dualScreenTop

                const optionsStr = Object.keys(options).reduce((acc, key) => {
                    acc.push(`${key}=${options[key]}`)
                    return acc
                }, []).join(',')

                this.newWindow = window.open(url, title, optionsStr)

                return this.newWindow
            },

        }
    }
</script>
