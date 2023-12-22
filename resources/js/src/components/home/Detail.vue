<template>
    
    <section>
        <div class="container-xl pt-4 pt-xl-5">
            <section>
                <div class="detail-img" :style="cssProps" alt=""></div>
                <div class="container-xl h-100 position-relative">
                    <div class="card">
                        <div class="card-body pt-5 p-4">
                            <div class="bs-icon-lg bs-icon-circle d-flex flex-shrink-0 justify-content-center align-items-center position-absolute mb-3 bs-icon lg">
                                <img class="img-mri" alt="Marketing Research Indonesia" :src="logo" />
                            </div>
                            <h2 class="card-title fw-bold">{{ job.title }}</h2>
                            <small class="text-muted">Job Posted {{ job.created_at }}</small>
                            <div>
                                <span class="badge rounded-pill bg-primary">
                                    <svg class="bi bi-briefcase-fill" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"></path>
                                        <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"></path>
                                    </svg> {{ job.type }}
                                </span>
                                <span class="badge rounded-pill bg-primary left-badge">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.05025 4.05025C7.78392 1.31658 12.2161 1.31658 14.9497 4.05025C17.6834 6.78392 17.6834 11.2161 14.9497 13.9497L10 18.8995L5.05025 13.9497C2.31658 11.2161 2.31658 6.78392 5.05025 4.05025ZM10 11C11.1046 11 12 10.1046 12 9C12 7.89543 11.1046 7 10 7C8.89543 7 8 7.89543 8 9C8 10.1046 8.89543 11 10 11Z" fill="currentColor"></path>
                                    </svg> {{ job.location }}
                                </span>
                                <span class="badge rounded-pill bg-primary left-badge">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-person-fill-exclamation" viewBox="0 0 20 20">
                                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4"/>
                                        <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                    </svg> {{ job.level }}
                                </span>
                            </div>
                            <hr />
                            <div class="job-text">
                                <h5 class="fw-bold">About the job</h5>
                                <div v-html="job.description"></div>
                            </div>
                            <div class="job-text">
                                <h5 class="fw-bold">Salary</h5>
                                <div>
                                    <span class="badge rounded-pill bg-primary">{{ job.salary }}</span>
                                </div>
                            </div>
                            <div class="job-text">
                                <h5 class="fw-bold">Requirements</h5>
                                <div v-html="job.requirements"></div>
                            </div>
                            <div class="job-text">
                                <h5 class="fw-bold">Qualifications</h5>
                                <div v-html="job.qualifications"></div>
                            </div>
                            <hr />
                            <div class="row gy-4">
                                <div class="col text-center">
                                    <button class="btn btn-primary" type="button">Apply</button>
                                </div>
                                <div class="col text-center"><button class="btn btn-primary" type="button">Chat</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</template>

<style scoped>

.job-text {
    margin-bottom: 2rem;
}

.card {
    border-radius: 10px;
}
.left-badge {
    margin-left: 1%;
}

.container-xl {
    top: -50px;
}

.btn-primary {
    border-radius: 10px;
    width: 100%;
}

.bs-icon-lg {
    top: -30px;
    background-color: var(--bs-white);
    border-width: 1px;
    border-color: var(--bs-primary);
    border-style: solid;
}

.img-mri {
    width: 40px;
    height: 40px;
}

</style>

<script>
    export default {
        name: 'my-detail',
        props: {
            job: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                id: '',
                user: '',
                loading: false,
                loginType: '',
                logo: '',
                cssProps: {
                    background: '',
                    borderRadius: '10px',
                    height: '200px',
                    // add more frosty effect
                    filter: 'brightness(1) saturate(1.2)',
                },
                isLoggedIn: false
            }
        },
        created() {
            this.setUser()
            this.logo = '/assets/img/logo/logo.webp'
            this.cssProps.background = `url(${this.job.image})`
            // this.loading = true
        },
        // mounted() {
            // this.rangeSalaryListener()

            // setTimeout(() => {
            //     this.loading = false
            // }, 1000)
        // },
        methods: {
            async setUser() {
                this.id = this.$cookies.get('id') ?? ''
                this.isLoggedIn = this.$cookies.get('user_token') != null

                if(this.id != '' && this.isLoggedIn) {
                    this.user = this.$store.state.user
                } 
            },

        }
    }
</script>