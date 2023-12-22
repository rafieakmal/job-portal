<template>
    <section class="py-4 py-md-5 mt-5">
        <div class="container-xl py-md-5">
            <div class="row">
                <div class="col-md-5 text-center" id="img-heading">
                    <img class="img-fluid w-100" alt="forgot password image" src="assets/img/illustrations/20824344_6343823.svg">
                </div>
                <div class="col text-start text-md-start">
                    <h2 class="display-6 fw-bold mb-5">Reset <span class="underline pb-1">Password</span></h2>
                    <form @submit.prevent="requestResetPassword">
                        <div class="mb-3">
                            <input v-model="user.password" v-show="!showPassword" @input="validatePassword" minlength="8" class="shadow-sm form-control" type="password" name="password" placeholder="Password" required>
                            <input v-model="user.password" v-show="showPassword" @input="validatePassword" minlength="8" class="shadow-sm form-control" type="text" name="password" placeholder="Password" required>
                        </div>
                        <div class="mb-3">
                            <input v-model="user.password_confirmation" v-show="!showPassword" @input="validatePassword" minlength="8" class="shadow-sm form-control" type="password" name="password_repeat" placeholder="Repeat Password" required>
                            <input v-model="user.password_confirmation" v-show="showPassword" @input="validatePassword" minlength="8" class="shadow-sm form-control" type="text" name="password_repeat" placeholder="Repeat Password" required>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input v-model="showPassword" class="form-check-input" type="checkbox" value="true" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Show Password
                                </label>
                            </div>
                        </div>
                        <div v-if="error">
                            <div style="color: red;"><span v-html="error"></span></div>
                        </div>
                        <div v-else>
                            <p style="color: green;">{{ message }}</p>
                        </div>
                        <div v-if="!isVerified" >
                            <vue-recaptcha ref="recaptcha" sitekey="6LfVTC4pAAAAAOBdUZZO-hNtoTaeQtlHYfjI7vZP" :theme="theme"
                                @verify="verifyMethod"
                                @expired="expiredMethod"
                                @render="renderMethod"
                                @error="errorMethod"
                            
                            ></vue-recaptcha>
                        </div>
                        <div v-else class="mb-5">
                            <button class="btn btn-primary shadow" type="submit" style="width: 100%;">Reset password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { VueRecaptcha } from 'vue-recaptcha'
    import verifyUser from '../../verifyUser.js'
    export default {
        name: "forgot-password",
        metaInfo: {
            title: "MRI Job Portal - Change Password",
        },
        components: { VueRecaptcha },
        props: {
            token: {
                type: String,
                required: true
            },
            email: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                error: '',
                message: null,
                isVerified: false,
                showPassword: false,
                theme: 'light',
                user: {
                    password: null,
                    password_confirmation: null,
                }
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
            async usingSymbol() {
                const regex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
                return regex.test(this.user.password)
            },
            async validatePassword() {
                let errorMessage = ''
                let error = false
                if (this.user.password !== this.user.password_confirmation) {
                    errorMessage += errorMessage ? '<br>Passwords do not match' : 'Passwords do not match'
                    this.validated = false
                    error = true
                }
                if (this.user.password.length < 8) {
                    errorMessage += errorMessage ? '<br>Password must be at least 8 characters' : 'Password must be at least 8 characters'
                    this.validated = false
                    error = true
                }


                if (!await this.usingSymbol()) {
                    errorMessage += errorMessage ? '<br>Password must contain at least one symbol' : 'Password must contain at least one symbol'
                    this.validated = false
                    error = true
                }

                if (await this.usingSymbol() && this.user.password.length >= 8 && this.user.password === this.user.password_confirmation) {
                    this.validated = true
                    errorMessage = ''
                    error = false
                }

                this.error = errorMessage
                return error;
            },
            async setUser() {
                this.id = this.$cookies.get('id') ?? ''
                this.isLoggedIn = this.$cookies.get('user_token') != null

                if (this.id != '' && this.isLoggedIn) {
                    let response = await verifyUser(this.id)
                    this.user = response
                    this.loading = false
                }
            },
            removeUserFromStore() {
                this.$store.commit('removeUser')
            },
            logout() {
                this.$cookies.remove('id')
                this.$cookies.remove('user_token')
                this.setUser()
                this.removeUserFromStore()

                this.$router.push('/login')
                window.scrollTo(0, 0)
            },
            async requestResetPassword() {
                let validated = await this.validatePassword()
                console.log(validated)
                if (validated) {
                    return
                }
                console.log(this.user)
                let formData = new FormData()
                formData.append('candidate_email', this.email)
                formData.append('token', this.token)
                formData.append('password', this.user.password)
                formData.append('password_confirmation', this.user.password_confirmation)
                await this.axios({
                    url: '/api/candidate/reset-password',
                    method: 'post',
                    data: formData,
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Acces-Control-Allow-Origin': '*',
                    }
                    }).then(response => {
                        this.error = false
                        this.message = 'Password reset successfully'
                        this.logout()
                    }).catch(err => {
                        this.error = true
                        this.message = 'Failed to reset password, because your token is expired.'
                    })
            },
        }
    }
</script>