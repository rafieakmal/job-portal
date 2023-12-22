<template>
    <nav class="navbar navbar-expand-lg navbar-shrink py-3 navbar-light" id="mainNav">
        <div class="container-xl"><a class="navbar-brand d-flex align-items-center" href="/"><span>MRI Job Portal</span></a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
                <span class="visually-hidden">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'home' }">Home</router-link>
                    </li>
                    
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'contact' }">Contacts</router-link>
                    </li>
                </ul>
                
                <div v-if="isLoggedIn">
                    <li class="nav-item dropdown no-arrow">
                        <div class="nav-item dropdown no-arrow">                                
                                <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                    <b-skeleton v-if="loading" animation="throb" type="avatar"></b-skeleton>
                                    <span v-if="!loading" class="d-none d-lg-inline me-2 text-gray-600 small">{{ user.candidate_name }}</span>
                                    <img v-if="!loading" class="border rounded-circle img-profile" alt="Profile Image" :src="user.candidate_profile_picture" />
                                    
                                </a>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                    <a class="dropdown-item" href="/user/profile">
                                        <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="/user/settings">
                                        <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i> Settings
                                    </a>
                                    <a class="dropdown-item" href="/user/account-management">
                                        <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Account Management
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" @click="logout"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                                </div>
                        </div>
                    </li>
                </div>
                <div v-else>
                    <a class="btn btn-primary shadow" role="button" href="/sign-up">Sign up</a>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped>

.nav-item.dropdown.no-arrow .dropdown-toggle::after {
    display: none;
}

.nav-item.dropdown.no-arrow {
    display: block;
    right: 0;
}

.img-profile {
    max-width: 30px;
    max-height: 30  px;
}

/* .theme-switcher {
    left: 0;
} */

.theme-switcher .dropdown-menu {
    min-width: 0rem !important;
}

.navbar-toggler {
    border: none;
}

.dropdown-menu {
    min-width: 0rem !important;
}

.dropdown-menu .dropdown-item {
    font-size: small;
}

/* maximize dropdown menu if device width is smaller */
@media (max-width: 991px) {
    .dropdown-menu {
        min-width: 100% !important;
    }

    .dropdown-menu .dropdown-item {
        padding-left: 1.5rem !important;
        padding-right: 1.5rem !important;
        font-size: small;
    }


}

.navbar {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: -3%;
}
</style>

<script>
    import verifyUser from '../../verifyUser'
    export default {
        name: 'my-navbar',
        data() {
            return {
                id: '',
                user: '',
                loginType: '',
                loading: false,
                isLoggedIn: false
            }
        },
        created() {
            this.loading = true
            this.setUser()
        },
        methods: {
            async setUser() {
                this.id = this.$cookies.get('id') ?? ''
                this.isLoggedIn = this.$cookies.get('user_token') != null    

                if (this.id != '' && this.isLoggedIn) {
                    this.user = this.$store.getters.getUser
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
            }
        },
    }
</script>

