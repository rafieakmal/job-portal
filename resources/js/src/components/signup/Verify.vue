<template>
    <section class="py-5 mt-5">
        <div class="container-xl py-4 py-xl-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h1 class="fw-bolder mb-4">Please choose one of the below methods to verify your account.</h1>
                </div>
            </div>
        </div>
        <div class="container-xl">
            <div class="alert alert-danger alert-dismissible fade show mb-5" id="error-message" role="alert" v-if="error">
                <strong>Error!</strong> {{ error }}
            </div>
            <div class="row gy-3">
                <div class="col-md-6">
                    <div class="card border-primary border-2 h-100" style="border-radius: 5px;">
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <div class="text-center">
                                <h3 class="fw-bold mb-4"><svg class="icon icon-tabler icon-tabler-mail text-primary" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 1%;margin-right: 1%;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                        <polyline points="3 7 12 13 21 7"></polyline>
                                    </svg>Verify using email</h3>
                            </div>
                            <a class="btn btn-primary" v-if="!email_send" role="button" @click="sendEmail()">Verify Now</a>
                            <a class="btn btn-primary" role="button" v-else><b-spinner small label="Spinning"></b-spinner> Loading...</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-primary border-2 h-100" style="border-radius: 5px;">
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <div class="text-center">
                                <h3 class="fw-bold mb-4"><svg class="icon icon-tabler icon-tabler-brand-whatsapp text-primary" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 1%;margin-right: 1%;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
                                        <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1"></path>
                                    </svg>Verify using whatsapp</h3>
                            </div><a class="btn btn-primary" role="button" v-if="!whatsapp_send" @click="sendWhatsapp()">Verify Now</a>
                            <a class="btn btn-primary" role="button" v-else><b-spinner small label="Spinning"></b-spinner> Loading...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script lang="ts">
import axios from 'axios';
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'Verify',
    data() {
        return {
            data_code: null,
            error: '',
            email_send: false,
            whatsapp_send: false,
        };
    },
    methods: {
        async sendWhatsapp() {
            try {
                const user = this.$store.state.user;

                this.whatsapp_send = true;
                const response = await axios.post('/api/candidate/send-code', {
                    receiver: user.candidate_phone,
                    type: 'wa',
                });

                if (response.data.status === 200) {
                    const token = response.data.detail?.token ?? null;
                    const acceptKey = response.data.detail?.key ?? null;

                    let route = '';

                    this.whatsapp_send = false;
                    if (!token && !acceptKey) {
                        route = '/verify-my-account';
                    } else {
                        route = `/verify-whatsapp?token=${token}&acceptKey=${acceptKey}`;
                    }

                    this.$router.push(route);
                } else {
                    this.whatsapp_send = false;
                    this.error = 'Something went wrong. Please try again.';
                }
            } catch (error) {
                this.error = 'Something went wrong. Please try again.';
            }
        },

        async sendEmail() {
            try {
                const user = this.$store.state.user;
                
                this.email_send = true;
                const response = await axios.post('/api/candidate/send-code', {
                    receiver: user.candidate_email,
                    type: 'email',
                });

                if (response.data.status === 200) {
                    const token = response.data.detail?.token ?? null;
                    const acceptKey = response.data.detail?.key ?? null;

                    let route = '';

                    this.email_send = false;
                    if (!token && !acceptKey) {
                        route = '/verify-my-account';
                    } else {
                        route = `/verify-email?token=${token}&acceptKey=${acceptKey}`;
                    }

                    this.$router.push(route);
                } else {
                    this.email_send = false;
                    this.error = 'Something went wrong. Please try again.';
                }
            } catch (error) {
                this.error = 'Something went wrong. Please try again.';
            }
        },
    },
});
</script>