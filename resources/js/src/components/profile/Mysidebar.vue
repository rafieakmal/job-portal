<template>
    <div id="offcanvas-menu" class="offcanvas-lg offcanvas-start bg-body" tabindex="-1" data-bs-backdrop="false" data-bs-keyboard="false">
        <div class="offcanvas-body d-flex flex-column justify-content-between pt-0">
            <div>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <router-link to="/user/profile">
                            <a class="nav-link active link-light profile" href="/profile" aria-current="page">
                                <svg class="bi bi-person-fill me-2" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
                                </svg> Profile
                            </a>
                            
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/user/settings">
                            <a class="nav-link link-body-emphasis settings">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-sliders me-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z"/>
                                </svg> Settings
                            </a>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/user/account-management">
                            <a class="nav-link link-body-emphasis management">
                                <svg class="bi bi-person-fill me-2" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
                                </svg> Account Management
                            </a>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "sidebar",
        props: {
            navbarActive: String,
        },
        mounted() {
            this.toggleSidebar()
        },
        methods: {
            toggleSidebar() {
                let navbarActive = this.navbarActive
                let profileSidebar = document.querySelector('.profile')
                let settingsSidebar = document.querySelector('.settings')
                let managementSidebar = document.querySelector('.management')

                if (navbarActive === 'profile') {
                    profileSidebar.classList.add('active')
                    profileSidebar.classList.add('link-light')
                    profileSidebar.classList.remove('link-body-emphasis')
                    settingsSidebar.classList.remove('active')
                    settingsSidebar.classList.remove('link-light')
                    settingsSidebar.classList.add('link-body-emphasis')
                    managementSidebar.classList.remove('active')
                    managementSidebar.classList.remove('link-light')
                    managementSidebar.classList.add('link-body-emphasis')
                } else if (navbarActive === 'management') {
                    profileSidebar.classList.remove('active')
                    profileSidebar.classList.remove('link-light')
                    profileSidebar.classList.add('link-body-emphasis')
                    managementSidebar.classList.remove('link-body-emphasis')
                    managementSidebar.classList.add('link-light')
                    managementSidebar.classList.add('active')
                    settingsSidebar.classList.remove('active')
                    settingsSidebar.classList.remove('link-light')
                    settingsSidebar.classList.add('link-body-emphasis')
                } else if (navbarActive === 'settings') {
                    profileSidebar.classList.remove('active')
                    profileSidebar.classList.remove('link-light')
                    profileSidebar.classList.add('link-body-emphasis')
                    managementSidebar.classList.remove('active')
                    managementSidebar.classList.remove('link-light')
                    managementSidebar.classList.add('link-body-emphasis')
                    settingsSidebar.classList.remove('link-body-emphasis')
                    settingsSidebar.classList.add('link-light')
                    settingsSidebar.classList.add('active')
                }
            }
        }
    }
</script>