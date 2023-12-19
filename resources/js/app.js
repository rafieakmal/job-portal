require('./bootstrap')

import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import router from './router/index'
import App from './src/App.vue'
import store from './store/index'
import VueMeta from 'vue-meta'
import Vue2Editor from "vue2-editor"
import VueClipboard from 'vue-clipboard2'
import VueSplit from 'vue-split-panel'
import VueCookies from 'vue-cookies'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueSweetalert2 from 'vue-sweetalert2';
import * as Sentry from "@sentry/vue"
import VueI18n from 'vue-i18n'
import verifyUser from './src/verifyUser'
import VModal from 'vue-js-modal'
import vSelect from 'vue-select'
import VueSanitize from "vue-sanitize"

import 'sweetalert2/dist/sweetalert2.min.css';
import 'vue-js-modal/dist/styles.css'
import 'vue-select/dist/vue-select.css';
// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(VueMeta)
Vue.use(VueRouter)
Vue.component('v-select', vSelect)
Vue.use(VueAxios, axios)
Vue.use(VueSplit)
Vue.use(VueClipboard)
Vue.use(Vue2Editor)
Vue.use(VueI18n)
Vue.use(VueSanitize)
Vue.use(VModal)
Vue.use(VueSweetalert2)

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueCookies)

const i18n = new VueI18n({
  locale: 'en', // default locale
  messages: {
    en: {
      login: 'Login',
    },
  },
});


Vue.config.productionTip = false;



router.beforeEach(async (to, from, next) => {
  if (to.matched.some(record => record.meta.isGuest)) {
    let token = Vue.$cookies.get('user_token') != null
    if (token) {
      next({
        path: '/',
      })
    } else {
        if (to.matched.some(record => record.meta.isReset)) {
          let email = Vue.$cookies.get('reset_email') != null
          if (!email) {
            next({
              path: '/',
            })
          } else {
            next()
          }
        }
      next()
    }
  } else if (to.matched.some(record => record.meta.requiresAuth)) {
    let token = Vue.$cookies.get('user_token') != null
    if (!token) {
      next({
        path: '/login',
      })
    } else {
      let id = Vue.$cookies.get('id')
      let userGet = null
      try {
        userGet = await verifyUser(id)
      } catch (error) {
        if (error.response.status == 400 || error.response.status == 401) {
          Vue.$cookies.remove('user_token')
          Vue.$cookies.remove('id')

          next({
            path: '/login',
          })

          return
        }
      }
      let userStore = store.commit('addUser', userGet)
      let user = store.state.user
      let roles = user.candidate_role
      let isEmailVerified = user.email_verified_at != null ? true : false
      let isPhoneVerified = user.phone_verified_at != null ? true : false
      let isPasswordSet = user.password_verified_at != null ? true : false
      if (to.matched.some(record => record.meta.isUser)) {
        if (roles.includes('user')) next()
        else if (roles === 'admin') {
          next({
            path: '/',
          })
        }
      } else if (to.matched.some(record => record.meta.isAdmin)) {
        if (roles.includes('admin')) next()
        else if (roles === 'user') {
          next({
            path: '/',
          })
        }
      } else {
        if (!isEmailVerified && !isPhoneVerified) {
          next({
            path: '/verify-my-account',
          })
        } else {
          next()
        }
      }
    }
  } else if (to.matched.some(record => record.meta.isUnverified)) {
    let token = Vue.$cookies.get('user_token') != null
    let id = Vue.$cookies.get('id')
    let userGet = await verifyUser(id)
    let userStore = store.commit('addUser', userGet)
    let user = store.state.user
    let roles = user.candidate_role
    let isEmailVerified = user.email_verified_at != null ? true : false
    let isPhoneVerified = user.phone_verified_at != null ? true : false
    let isPasswordSet = user.password_verified_at != null ? true : false
    if (!token) {
      next({
        path: '/login',
      })
    } else {
      if (isEmailVerified || isPhoneVerified) {
        next({
          path: '/',
        })
      } else {
        next()
      }
    }
  } else {
    next()
  }
})

Sentry.init({
  Vue,
  dsn: "https://c79e612aa725c116400ad23843f11911@o4506318894596096.ingest.sentry.io/4506318896758784",
  integrations: [
    new Sentry.BrowserTracing({
      tracePropagationTargets: ["localhost", /^https:\/\/yourserver\.io\/api/],
      routingInstrumentation: Sentry.vueRouterInstrumentation(router),
    }),
    new Sentry.Replay(),
  ],
  // Performance Monitoring
  tracesSampleRate: 1.0, // Capture 100% of the transactions
  // Session Replay
  replaysSessionSampleRate: 0.1,
  replaysOnErrorSampleRate: 1.0,
})

const app = new Vue({
  el: '#app',
  router,
  i18n,
  store: store,
  components: {
    App
  }
})
