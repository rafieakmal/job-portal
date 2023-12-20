<template>
    <section class="py-5 mt-5">
        <div class="container-xl">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Hello, <strong>{{ user.candidate_name }}</strong>! Welcome to MRI Job Portal. We are currently in the <strong>designing</strong> phase. Please report any bugs or issues to Mr. <strong>Hendra</strong>. Thank you!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <div class="container-xl">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-text search-icon">
                            <svg class="icon icon-tabler icon-tabler-search" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="10" cy="10" r="7"></circle>
                                <line x1="21" y1="21" x2="15" y2="15"></line>
                            </svg>
                        </span>
                        <input class="form-control" type="text" placeholder="Type your dream job here" />
                        <button class="btn btn-primary search-button" type="button">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xl ctr-alert">
            <div class="row">
                <div class="col-md-3 filter-job">
                    <div class="sticky-top">
                        <!-- <div class="card filter-card">
                            <section>
                                <div style="background: url('https://cdn.bootstrapstudio.io/placeholders/1400x800.png') center / cover;height: 150px;border-radius: 10px;border-width: 1px;"></div>
                                <div class="container h-100 position-relative" style="top: -50px;">
                                    <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center position-absolute mb-3 bs-icon lg" style="top: -30px;margin-top: 20px;"><svg class="bi bi-bell" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"></path>
                                        </svg></div>
                                </div>
                            </section>
                        </div> -->
                        <div class="card text-bg-primary filter-card">
                            <div class="card-body">
                                <h6 class="fs-5 fw-bold text-white card-title">Create Job alert</h6>
                                <p class="fw-lighter text-white alert-paragraph">Create a job alert now and never miss a job</p>
                                <form>
                                    <input class="form-control alert-input" type="email" placeholder="Enter your email" required />
                                    <button class="btn btn-light btn-sm alert-button" type="submit">Create Job Alerts</button>
                                </form>
                            </div>
                        </div>
                        <div class="card filter-job-card">
                            <div class="card-body">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h6 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Type of Employment
                                        </button>
                                        </h6>
                                        <div id="collapseOne" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                <div class="form-check">
                                                    <input id="formCheck-1" class="form-check-input" type="checkbox" />
                                                    <label class="form-check-label" for="formCheck-1">Full TIme Jobs 
                                                        <!-- <span class="badge bg-primary">42</span> -->
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="formCheck-4" class="form-check-input" type="checkbox" />
                                                    <label class="form-check-label" for="formCheck-4">Part Time Jobs 
                                                        <!-- <span class="badge bg-primary">42</span> -->
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="formCheck-3" class="form-check-input" type="checkbox" />
                                                    <label class="form-check-label" for="formCheck-3">Remote Jobs 
                                                        <!-- <span class="badge bg-primary">42</span> -->
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="formCheck-2" class="form-check-input" type="checkbox" />
                                                    <label class="form-check-label" for="formCheck-2">Internship Jobs 
                                                        <!-- <span class="badge bg-primary">42</span> -->
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h6 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Seniority Level
                                        </button>
                                        </h6>
                                        <div id="collapseTwo" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <div class="form-check">
                                                    <input id="formCheck-5" class="form-check-input" type="checkbox" />
                                                    <label class="form-check-label" for="formCheck-5">Student Level 
                                                        <!-- <span class="badge bg-primary">42</span> -->
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="formCheck-6" class="form-check-input" type="checkbox" />
                                                    <label class="form-check-label" for="formCheck-6">Mid Level 
                                                        <!-- <span class="badge bg-primary">42</span> -->
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="formCheck-7" class="form-check-input" type="checkbox" />
                                                    <label class="form-check-label" for="formCheck-7">Senior Level 
                                                        <!-- <span class="badge bg-primary">42</span> -->
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h6 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                            Salary Range
                                        </button>
                                        </h6>
                                        <div id="collapse3" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <label for="range-salary" class="float-start">Rp. 0</label>
                                                <label for="range-salary" class="float-end">Rp. 50.000.000</label>
                                                <input type="range" min="0" max="50000000" step="1000000" class="form-range" id="range-salary">
                                                <p>Select from range: Rp. {{ salary }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- <div>
                        <h6 class="fw-semibold filter-heading-job">Type of Employment</h6>
                        <div class="form-check">
                            <input id="formCheck-1" class="form-check-input" type="checkbox" />
                            <label class="form-check-label" for="formCheck-1">Full TIme Jobs 
                                <span class="badge bg-primary">42</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input id="formCheck-4" class="form-check-input" type="checkbox" />
                            <label class="form-check-label" for="formCheck-4">Part Time Jobs 
                                <span class="badge bg-primary">42</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input id="formCheck-3" class="form-check-input" type="checkbox" />
                            <label class="form-check-label" for="formCheck-3">Remote Jobs 
                                <span class="badge bg-primary">42</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input id="formCheck-2" class="form-check-input" type="checkbox" />
                            <label class="form-check-label" for="formCheck-2">Internship Jobs 
                                <span class="badge bg-primary">42</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-semibold filter-heading-job">Seniority Level</h6>
                        <div class="form-check">
                            <input id="formCheck-5" class="form-check-input" type="checkbox" />
                            <label class="form-check-label" for="formCheck-5">Student Level 
                                <span class="badge bg-primary">42</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input id="formCheck-6" class="form-check-input" type="checkbox" />
                            <label class="form-check-label" for="formCheck-6">Mid Level 
                                <span class="badge bg-primary">42</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input id="formCheck-7" class="form-check-input" type="checkbox" />
                            <label class="form-check-label" for="formCheck-7">Senior Level 
                                <span class="badge bg-primary">42</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-semibold filter-heading-job">Salary Range</h6>
                        <div class="form-check">
                            <input id="formCheck-9" class="form-check-input" type="checkbox" />
                            <label class="form-check-label" for="formCheck-9">IDR Rp. 3.000.000 
                                <span class="badge bg-primary">42</span>
                            </label>
                        </div>
                    </div> -->
                </div>
                <div class="col" data-bs-spy="scroll">
                    <div>
                        <div class="row">
                            <div class="col">
                                <h3 class="fw-semibold">All Jobs Available</h3>
                            </div>
                            <div class="col text-end">
                                <div class="dropdown sort"><button class="btn dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">Sort By</button>
                                    <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-4">
                        <div class="col-md-4">
                            <div class="card job-card">
                                <div class="card-body">
                                    <div v-if="loading">
                                            <b-skeleton-img animation="throb" no-aspect height="30px" class="mb-3"></b-skeleton-img>
                                            <b-skeleton animation="throb" width="85%"></b-skeleton>
                                            <b-skeleton animation="throb" width="55%"></b-skeleton>
                                            <b-skeleton animation="throb" width="70%"></b-skeleton>
                                            <b-skeleton animation="throb" width="85%"></b-skeleton>
                                            <b-skeleton animation="throb" type="button" width="100%" class="mt-3"></b-skeleton>
                                        </div>
                                    <div v-else>
                                        <div class="row">
                                            <div class="col" style="margin-bottom: 10%;">
                                                <picture>
                                                    <img class="img-fluid job-logo" src="assets/img/logo/logoheader.png" />
                                                </picture>
                                            </div>
                                            <div class="col text-end"><svg class="icon icon-tabler icon-tabler-dots fs-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <circle cx="5" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="19" cy="12" r="1"></circle>
                                                </svg>
                                            </div>
                                        </div>

                                        <h5 class="fw-bold card-title mb-2">UI / UX Designer</h5>
                                        <p class="span-job">We believe that design (and you) will be critical to the company&#39;s success. You will work with our founders and our early customers to help define and build our product functionality,..</p>
                                        <button class="btn btn-primary job-button-apply" type="button">Apply Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card job-card">
                                <div class="card-body">
                                    <div v-if="loading">
                                            <b-skeleton-img animation="throb" no-aspect height="30px" class="mb-3"></b-skeleton-img>
                                            <b-skeleton animation="throb" width="85%"></b-skeleton>
                                            <b-skeleton animation="throb" width="55%"></b-skeleton>
                                            <b-skeleton animation="throb" width="70%"></b-skeleton>
                                            <b-skeleton animation="throb" width="85%"></b-skeleton>
                                            <b-skeleton animation="throb" type="button" width="100%" class="mt-3"></b-skeleton>
                                        </div>
                                    <div v-else>
                                        <div class="row">
                                            <div class="col" style="margin-bottom: 10%;">
                                                <picture>
                                                    <img class="img-fluid job-logo" src="assets/img/logo/logoheader.png" />
                                                </picture>
                                            </div>
                                            <div class="col text-end"><svg class="icon icon-tabler icon-tabler-dots fs-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <circle cx="5" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="19" cy="12" r="1"></circle>
                                                </svg>
                                            </div>
                                        </div>

                                        <h5 class="fw-bold card-title mb-2">IT Developer</h5>
                                        <p class="span-job">We believe that design (and you) will be critical to the company&#39;s success. You will work with our founders and our early customers to help define and build our product functionality,..</p>
                                        <button class="btn btn-primary job-button-apply" type="button">Apply Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card job-card">
                                <div class="card-body">
                                    <div v-if="loading">
                                            <b-skeleton-img animation="throb" no-aspect height="30px" class="mb-3"></b-skeleton-img>
                                            <b-skeleton animation="throb" width="85%"></b-skeleton>
                                            <b-skeleton animation="throb" width="55%"></b-skeleton>
                                            <b-skeleton animation="throb" width="70%"></b-skeleton>
                                            <b-skeleton animation="throb" width="85%"></b-skeleton>
                                            <b-skeleton animation="throb" type="button" width="100%" class="mt-3"></b-skeleton>
                                        </div>
                                    <div v-else>
                                        <div class="row">
                                            <div class="col" style="margin-bottom: 10%;">
                                                <picture>
                                                    <img class="img-fluid job-logo" src="assets/img/logo/logoheader.png" alt="" />
                                                </picture>
                                            </div>
                                            <div class="col text-end"><svg class="icon icon-tabler icon-tabler-dots fs-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <circle cx="5" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="19" cy="12" r="1"></circle>
                                                </svg>
                                            </div>
                                        </div>

                                        <h5 class="fw-bold card-title mb-2">IT Support</h5>
                                        <p class="span-job">We believe that design (and you) will be critical to the company&#39;s success. You will work with our founders and our early customers to help define and build our product functionality,..</p>
                                        <button class="btn btn-primary job-button-apply" type="button">Apply Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="card job-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col" style="margin-bottom: 10%;">
                                            <picture>
                                                <img class="img-fluid job-logo" src="assets/img/logo/logoheader.png" />
                                            </picture>
                                        </div>
                                        <div class="col text-end"><svg class="icon icon-tabler icon-tabler-dots fs-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="5" cy="12" r="1"></circle>
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                            </svg></div>
                                    </div>
                                    <h5 class="fw-bold card-title mb-2">IT Developer</h5>
                                    <p class="span-job">We believe that design (and you) will be critical to the company&#39;s success. You will work with our founders and our early customers to help define and build our product functionality,..</p>
                                    <button class="btn btn-primary job-button-apply" type="button">Apply Now</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card job-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col" style="margin-bottom: 10%;">
                                            <picture>
                                                <img class="img-fluid job-logo" src="assets/img/logo/logoheader.png" />
                                            </picture>
                                        </div>
                                        <div class="col text-end"><svg class="icon icon-tabler icon-tabler-dots fs-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="5" cy="12" r="1"></circle>
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                            </svg></div>
                                    </div>
                                    <h5 class="fw-bold card-title mb-2">IT Support</h5>
                                    <p class="span-job">We believe that design (and you) will be critical to the company&#39;s success. You will work with our founders and our early customers to help define and build our product functionality,..</p>
                                    <button class="btn btn-primary job-button-apply" type="button">Apply Now</button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

.alert {
    border-radius: 10px;
}
.form-check-label span {
    right: 0;
}

.accordion-item {
    margin-bottom: 0.5rem;
}

.sticky-top {
    top: 20px;
}


.accordion-button {
    padding: 0.5rem 0.5rem;
    font-size: 0.9rem;
    border-radius: 0.25rem;
}

.accordion-body {
    padding: 0.5rem 1rem;
    font-size: 0.8rem;
}

.alert-button {
    border-radius: 10px;
    width: 100%;
}

.alert-input {
    border-radius: 10px;
    margin-top: 5%;
    margin-bottom: 5%;
}

.filter-job-card {
    border-radius: 10px;
}

/* .dropdown.sort {
    margin-bottom: 3%;
} */

.span-job {
    margin-bottom: 5%;
    font-size: small;
}

.ctr-alert {
   margin-top: 2%;
}

.alert-paragraph {
    margin-top: 5%;
    margin-bottom: 5%;
    font-size:medium;
}
.filter-card {
    border-radius: 10px;
    margin-bottom: 5%;
}

.search-icon {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}
.search-button {
    border-bottom-right-radius: 10px;
    border-top-right-radius: 10px;
}

.job-logo {
   max-width: 100%;
}

.filter-heading-job {
    margin-top: 6%;
    margin-bottom: 6%;
}

.badge.bg-primary {
    border-radius: 10px;
}

.job-card {
    border-width: 1px;
    border-radius: 10px;
}

.job-button-apply {
    max-width: 100%;
    min-width: 100%;
    border-radius: 10px;
}

/* @media (min-width: 1300px) {
    
    .job-card:hover {
        transform: scale(1.05);
        transition: 0.5s;
    }
} */

@media (max-width: 1300px) {
    .filter-job {
        display: none;
    }
}

</style>

<script>
    import verifyUser from '../../verifyUser'
    export default {
        name: 'my-home',
        data() {
            return {
                id: '',
                user: '',
                loading: false,
                loginType: '',
                salary: 0,
                isLoggedIn: false
            }
        },
        created() {
            this.setUser()
            this.loading = true
        },
        mounted() {
            this.rangeSalaryListener()

            setTimeout(() => {
                this.loading = false
            }, 1000)
        },
        methods: {
            async setUser() {
                this.id = this.$cookies.get('id') ?? ''
                this.isLoggedIn = this.$cookies.get('user_token') != null

                if(this.id != '' && this.isLoggedIn) {
                    this.user = this.$store.state.user
                } 
            },

            salaryFormat(salary) {
                return salary.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })
            },

            rangeSalaryListener() {
                let rangeSalary = document.getElementById('range-salary')
                rangeSalary.addEventListener('input', () => {
                    this.salary = rangeSalary.value
                })
            }
        }
    }
</script>