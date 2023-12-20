<template>
    <section class="py-4 py-md-5 my-5">
        <div class="container-xl py-md-5">
            <div class="row">
                <div class="col-md-7 text-center" id="img-heading">
                    <img class="img-fluid w-100" src="assets/img/illustrations/7070629_3293466.svg">
                </div>
                <div class="col text-start text-md-start">
                    <vue-typed-js :typeSpeed="50" :showCursor="false" :autoInsertCss="true" :contentType="'html'" :backSpeed="2" :strings="['<span>Sign up</span>']">
                        <h2 class="typing display-6 fw-semibold mb-5 underline pb-1"></h2>
                    </vue-typed-js>
                    <form @submit.prevent="registration" data-bs-theme="light">
                        <div class="mb-3">
                            <input v-model="user.full_name" class="form-control" type="text" name="full_name" placeholder="Full Name">
                        </div>
                        <div class="mb-3">
                            <input v-model="user.phone" @input="sanitizePhone()" class="shadow-sm form-control" type="number" name="phone" placeholder="Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <input v-model="user.email" class="shadow-sm form-control" type="email" name="email" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input v-model="user.password" v-show="!showPassword" @input="validatePassword" class="shadow-sm form-control" type="password" name="password" placeholder="Password" minlength="8" required>
                            <input v-model="user.password" v-show="showPassword" @input="validatePassword" class="shadow-sm form-control" type="text" name="password" placeholder="Password" minlength="8" required>
                        </div>
                        <div class="mb-3">
                            <input v-model="user.password_confirmation" v-show="!showPassword" @input="validatePassword" class="shadow-sm form-control" type="password" name="password_repeat" placeholder="Repeat Password" minlength="8" required>
                            <input v-model="user.password_confirmation" v-show="showPassword" @input="validatePassword" class="shadow-sm form-control" type="text" name="password_repeat" placeholder="Repeat Password" minlength="8" required>
                        </div>
                        <div class="mb-3 text-start">
                            <div class="form-check">
                                <input v-model="showPassword" class="form-check-input" type="checkbox" value="true" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Show Password
                                </label>
                            </div>
                        </div>
                        <div v-if="errorMessage">
                            <div style="color: red;"><span v-html="errorMessage"></span></div>
                        </div>
                        <div class="text-center mb-5">
                            <div v-if="!isVerified" >
                                <vue-recaptcha ref="recaptcha" sitekey="6LfVTC4pAAAAAOBdUZZO-hNtoTaeQtlHYfjI7vZP" 
                                    @verify="verifyMethod"
                                    @expired="expiredMethod"
                                    @render="renderMethod"
                                    @error="errorMethod"
                                ></vue-recaptcha>
                            </div>
                            <div v-if="isVerified">
                                <button v-if="validated" class="btn btn-primary shadow" type="submit">Create account</button>
                                <button v-else class="btn btn-primary shadow disabled" type="submit">Create account</button>
                            </div>
                            <div class="divider d-flex align-items-center my-4">
                                <p class="text-center mx-3 mb-0">or</p>
                            </div>
                            <button class="btn btn-light fw-lighter shadow" @click="loginGoogle" type="button">
                                <img src="assets/img/pngwing.com.png" class="google-btn-img">
                                Log in Using Google
                            </button>
                        </div>
                    </form>
                    <p>Have an account? <a href="/login">Log in&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-arrow-narrow-right">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <line x1="15" y1="16" x2="19" y2="12"></line>
                                <line x1="15" y1="8" x2="19" y2="12"></line>
                            </svg>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type='number'] {
    -moz-appearance: textfield;
}

.fw-lighter.shadow {
    width: 100%;
}

.btn-primary.shadow {
    width: 100%;
}

.google-btn-img {
    margin-right: 10px;
    margin-top: 0px;
    margin-bottom: 2px;
    max-height: 100%;
    max-width: 3%;
}

.dropzone-custom-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

.dropzone-custom-image {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 30%;
}

.dropzone-custom-title {
  margin-top: 0;
  color: #128cd7;
}

.subtitle {
  color: #314b5f;
}

</style>
<script>
    import { VueRecaptcha } from 'vue-recaptcha'
    export default {
        name: "sign-up",
        metaInfo: {
            title: "MRI Job Portal - Registration",
        },
        components: {
            VueRecaptcha
        },
        data() {
            return {
                showPassword: false,
                blob: '',
                user: {
                    email: '',
                    password: '',
                    full_name: '',
                    password_confirmation: '',
                    phone: '',
                },
                state: {
                    isLoading: true,
                },
                isVerified: false,
                captureSrc:'',
                errorMessage: '',
                isCameraLoaded: false,
                dismissSecs: 5,
                dismissCountDown: 0,
                phoneSecs: 5,
                phoneCountDown: 0,
                intervalId: null,
                code: '',
                phone: '',
                validated: false,
                generatedCode: '',
                timer: null,
                isTimer: false,
                timeRemaining: 30,
                displaySize: { width: 640, height: 480 },
                dropzoneOptions: {
                    url: 'http://localhost:70/post',
                    thumbnailWidth: 150,
                    maxFiles: 1,
                    addRemoveLinks: true,
                    duplicateCheck: true,
                }
            }
        },
        beforeDestroy() {
            clearInterval(this.intervalId)
            clearInterval(this.timer)
        },
        computed: {
            phoneState() {
                return this.user.phone.length >= 10 && this.user.phone.length < 14 ? true : false
            },
        },
        methods: {
            onEvent() {
                this.$refs.recaptcha.execute();
            },

            verifyMethod(response) {
                this.isVerified = true
            },
            expiredMethod() {
                this.isVerified = false
            },
            renderMethod() {
                console.log('%c[ System ]: Google Recaptcha Rendered', 'background-color: green; font-size: larger');
            },
            errorMethod(error) {
                this.isVerified = false
                console.log(`Error: ${error}`)
            },

            sanitizePhone() {
                var text = this.checkPhone(this.user.phone)
                this.user.phone = text
                return this.user.phone
            },

            async loginGoogle() {
                const { data } = await axios.post('/api/google-redirect')
                // return this.openWindow(data.url, 'Google Login', { width: 500, height: 600 })
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

            checkPhone(text) {
                return text.toString().toLowerCase()
                    .replace('+62', '')
            },

            checkPhoneValidity() {
                const phoneRegex = /^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$/
                const valid = this.user.phone.length > 9 && this.user.phone.length < 15 ? true : false
                const validate = phoneRegex.test(this.user.phone)
                if (!valid || !validate) {
                    return false
                }

                return validate
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

                this.errorMessage = errorMessage
                return error;
            },

            async verification() {
                const full_name = this.user.full_name ?? false
                const email = this.user.email ?? false
                const password = this.user.password ?? false
                const password_confirmation = this.user.password_confirmation ?? false
                const phone = this.user.phone ?? false

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

                if (!full_name || !email || !password || !password_confirmation || !phone) {
                    errorMessage += errorMessage ? '<br>Please fill all the fields' : 'Please fill all the fields'
                    this.validated = false
                    error = true
                }

                if (!this.checkPhoneValidity()) {
                    errorMessage += errorMessage ? '<br>Wrong phone number. Please try again.' : 'Wrong phone number. Please try again.'
                    this.validated = false
                    error = true
                }

                if (await this.usingSymbol() && this.user.password.length >= 8 && this.user.password === this.user.password_confirmation) {
                    this.validated = true
                    errorMessage = ''
                    error = false
                }

                this.errorMessage = errorMessage
                return;
            },

            async registration() {
                await this.verification()
                if (!this.validated) {
                    return
                }

                const email = this.user.email
                const full_name = this.user.full_name
                const password = this.user.password
                const password_confirmation = this.user.password_confirmation
                const phone = this.user.phone

                const formData = new FormData()
                formData.append('email', email)
                formData.append('full_name', full_name)
                formData.append('password', password)
                formData.append('password_confirmation', password_confirmation)
                formData.append('phone', phone)

                const response = await this.axios({
                    url: '/api/candidate/registration',
                    method: 'post',
                    data: formData,
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Access-Control-Allow-Origin': '*',
                    }
                })
                .then(response => {
                    var id = response.data.user_id ?? false
                    var token = response.data.token ?? false
                    if (!id || !token) {
                        this.errorMessage = 'Failed to register. Please try again.'
                        return
                    }

                    this.$cookies.set('id', id, '1d')
                    this.$cookies.set('user_token', token, '1d')

                    this.$emit('loggedIn')
                    this.$router.push('/')
                })
                .catch(err => {
                    this.errorMessage = 'Duplicate email or phone number. Please try again.'
                })


                
            },
        }

    }
    
</script>