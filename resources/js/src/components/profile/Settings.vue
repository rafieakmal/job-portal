<template>
    <section class="py-5 my-5">
        <div class="container-xl">
            <div class="row gx-2">
                <div class="col-auto"><img class="rounded-circle" :src="user.candidate_profile_picture" alt="profile" width="50px" height="50px" /></div>
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
                    <Sidebar navbar-active="settings" />
                </div>
                <div class="col-lg">
                    <h3>Settings</h3>
                    <hr />
                    <form>
                        <div>
                            <label class="form-label" for="full_name">Appearance</label>
                            <div class="theme-switcher btn-group" role="group">
                                <button data-bs-theme-value="auto" class="btn btn-primary btn-first btn-change-theme" type="button" @click.prevent="setTheme('auto')">System</button>
                                <button data-bs-theme-value="light" class="btn btn-primary btn-change-theme" type="button" @click.prevent="setTheme('light')">Light</button>
                                <button data-bs-theme-value="dark" class="btn btn-primary btn-last btn-change-theme" type="button" @click.prevent="setTheme('dark')">Dark</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.btn-group {
    width: 100%;
    border-radius: 5px;
}

.btn-first {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

.btn-last {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}

</style>

<script>
    import Sidebar from './Mysidebar.vue'
    
    import { getStoredTheme, setStoredTheme, getPreferredTheme, setTheme, showActiveTheme } from '../../../../../public/assets/js/darkmode.min.js'
    export default {
        name: "settings",
        components: { Sidebar },
        data() {
            return {
                timer: 5,
                user: null,
                theme: null,
                interval: null
            }
        },
        created() {
            this.getUser()
            this.getTheme()
        },
        mounted() {
            this.setActiveButton()
        },
        methods: {
            async getUser() {
                let user = this.$store.state.user
                this.user = user
            },

            async getTheme() {
                let theme = getStoredTheme()
                this.theme = theme
            },

            setActiveButton() {
                let theme = this.theme
                let buttons = document.querySelectorAll('.btn-change-theme')
                buttons.forEach(button => {
                    if (button.dataset.bsThemeValue == theme) {
                        button.classList.add('active')
                    } else {
                        button.classList.remove('active')
                    }
                })
            },

            setTheme(theme) {
                if (theme == null || theme == undefined) {
                    return
                }

                if (theme == 'auto') {
                    setStoredTheme(theme)
                    setTheme(theme);
                    showActiveTheme(theme)
                } else if (theme == 'light') {
                    setStoredTheme(theme)
                    setTheme(theme);
                    showActiveTheme(theme)
                } else if (theme == 'dark') {
                    setStoredTheme(theme)
                    setTheme(theme);
                    showActiveTheme(theme)
                } else {
                    return
                }
            }
        }
    }
</script>