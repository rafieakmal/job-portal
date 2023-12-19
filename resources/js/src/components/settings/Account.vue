<template>
    <section class="py-5 my-5">
        <div class="container-xl">
            <div class="row gx-2">
                <div class="col-auto"><img class="rounded-circle" :src="user.candidate_profile_picture" alt="profile"
                        width="50px" height="50px" /></div>
                <div class="col d-inline justify-content-xxl-start align-items-xxl-start" style="margin-top: 5px;">
                    <h5 style="margin-bottom: -2px;">{{ user.candidate_name }} ({{ user.candidate_username }})</h5>
                    <p class="text-muted" style="font-size: 12px;">Your personal account</p>
                </div>
            </div>
        </div>
        <!-- <div class="container-xl">
            <hr />
        </div> -->
        <div class="container-xl">
            <div class="row">
                <div class="col-3">
                    <Sidebar navbar-active="management" />
                </div>
                <div class="col-lg">
                    <h3>Account Management</h3>
                    <hr />   
                    <form>
                        <b-table hover :items="items" :busy="isBusy" :borderless="true" thead-class="hidden">
                            <template #cell(time)="data">
                                <div v-html="data.value"></div>
                            </template>
                            <template #table-busy>
                                <div class="text-center text-primary my-2">
                                    <b-spinner class="align-middle"></b-spinner>
                                    <strong>Loading...</strong>
                                </div>
                            </template>
                        </b-table>
                        <hr />
                        <div class="text-center mt-2">
                            <button class="btn btn-danger shadow myform" type="button" @click="deleteAccount()"
                                style="width: 100%;">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.form-control {
    border-radius: 4px;
    border-color: #ccc;
}

.shadow.myform {
    border-radius: 4px;
}

@media (max-width: 991px) {
    .button-setting {
        width: 100%;
    }
}
</style>

<script>
import Sidebar from './Mysidebar.vue'
import timesago from 'timesago'
export default {
    name: "account-management",
    components: { Sidebar },
    // Data for user
    data() {
        return {
            timer: 5,
            user: null,
            change: {
                profile_picture: null
            },
            items: null,
            interval: null,
            coordinates: {
                width: 0,
                height: 0,
                left: 0,
                top: 0,
            },
            image: null,
            isBusy: true,
            isDataChanged: false,
            isLoaded: false,
        }
    },
    // Get user data from store after component is created
    created() {
        this.getUser()
    },
    methods: {
        // Get user data from store
        async getUser() {
            let user = this.$store.state.user
            this.items = [
                {
                    data: 'Status',
                    time: `<span class="badge bg-success">Online</span>`,
                },
                {
                    data: 'Last login',
                    time: timesago(user.candidate_last_login)
                },
                {
                    data: 'Account created',
                    time: timesago(user.created_at)
                },
                {
                    data: 'Email verified at',
                    time: user.email_verified_at ? timesago(user.email_verified_at) : `<button class="btn btn-primary btn-sm button-setting" type="button" style="width: 100%">Add Email</button>`
                },
                {
                    data: 'Phone verified at',
                    time: user.phone_verified_at ? timesago(user.phone_verified_at) : `<button class="btn btn-primary btn-sm button-setting" type="button" style="width: 100%">Add Phone Number</button>`
                },
                {
                    data: 'Password',
                    time: `<button class="btn btn-primary btn-sm button-setting" onclick="window.location.href = '/forgot-password'" type="button" style="width: 100%">Change Password</button>`
                },
            ]
            this.user = user
            this.isBusy = false
        },

        // Delete account
        deleteAccount() {
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$swal(
                        'Deleted!',
                        'Your account has been deleted.',
                        'success'
                    )
                } else if (result.dismiss === this.$swal.DismissReason.cancel) {
                    this.$swal(
                        'Cancelled',
                        'Your account is safe :)',
                        'error'
                    )
                }
            })
        },
    }
}
</script>