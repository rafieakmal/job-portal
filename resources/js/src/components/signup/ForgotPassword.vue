<template>
    <section class="py-4 py-md-5 mt-5">
        <div class="container-xl py-md-5">
            <div class="row d-flex align-items-center">
                <div class="col-md-4 text-center" id="img-heading">
                    <img class="img-fluid w-100" src="assets/img/illustrations/24488359_6960658.svg" alt="forgot password image">
                </div>
                <div class="col text-start text-md-start">
                    <vue-typed-js :typeSpeed="80" :showCursor="false" :autoInsertCss="true" :smartBackspace="true" :backSpeed="50" :strings="['Change your password?', 'Reset your password?', 'Add your password?']">
                        <h2 class="typing display-6 fw-semibold mb-5 underline"></h2>
                    </vue-typed-js>
                    <p class="text-muted">Enter the email associated with your account and we'll send you a reset link.</p>
                    <form @submit.prevent="requestResetPassword">
                        <div class="mb-3">
                            <input class="shadow form-control" type="email" name="email" placeholder="Email" v-model="email" required>
                        </div>
                        <div v-if="!isLoading">
                            <button class="btn btn-primary shadow" type="submit" style="width: 100%;">Send Reset Link</button>
                        </div>
                        <div v-else>
                            <button class="btn btn-primary shadow" type="button" style="width: 100%;">
                                <b-spinner small label="Spinning"></b-spinner> Loading...
                            </button>
                        </div>
                        
                        <div v-show="isError">
                            <p style="color: red;">{{ message }}</p>
                        </div>
                        <div v-show="!isError">
                            <p style="color: green;">{{ message }}</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { VueTypedJs } from 'vue-typed-js'
    export default {
        name: "forgot-password",
        metaInfo: {
            title: "MRI Job Portal - Forgot Password",
        },
        components: {
            VueTypedJs
        },
        data() {
            return {
                email: null,
                isError: false,
                isLoading: false,
                message: null
            }
        },
        methods: {
            async requestResetPassword() {
                this.isLoading = true
                let formData = new FormData()
                formData.append('candidate_email', this.email)
                await this.axios({
                    url: '/api/candidate/reset-password-link',
                    method: 'post',
                    data: formData,
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Acces-Control-Allow-Origin': '*',
                    }
                }).then(response => {
                    this.isLoading = false,
                    this.isError = false,
                    // this.message = 'Password Reset Email Has Been Sent To Your Email Address'
                    this.$swal({
                        title: 'Password Reset Email Has Been Sent',
                        text: 'Please check your email to reset your password',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                }).catch(err => {
                    this.isLoading = false,
                    this.isError = true,
                    this.message = 'Something went wrong. Please try again later.'
                    console.log(err)
                })
            },
        }
    }
</script>