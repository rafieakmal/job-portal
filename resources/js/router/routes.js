import ContactPage from '../src/pages/ContactPage'
import HomePage from '../src/pages/HomeComponent'
import NotFound from '../src/pages/NotFoundComponent.vue'
import SignUp from '../src/pages/SignUpComponent.vue'
import Login from '../src/pages/LoginComponent.vue'
import ForgotPassword from '../src/pages/ForgotPasswordComponent.vue'
import ForgotPasswordForm from '../src/components/signup/ForgotPasswordForm.vue'
import Onboarding  from '../src/components/signup/Onboarding.vue'
import VerifyPage from '../src/pages/VerifyPage.vue'
import Profile from '../src/pages/ProfilePage.vue'
import Account from '../src/pages/AccountPage.vue'
import Settings from '../src/pages/SettingsPage.vue'
// import Whatsapp from '../src/components/signup/Whatsapp.vue'
import Whatsapp from '../src/pages/WhatsappPage.vue'
import Email from '../src/pages/EmailPage.vue'


const routes = [
  {
    path: '/',
    name: 'home',
    component: HomePage,
    meta: {
      requiresAuth: true
    },
  },
  {
    path: '/contact',
    name: 'contact',
    component: ContactPage,
  },
  {
    path: '/verify-my-account',
    name: 'verify-my-account',
    component: VerifyPage,
    meta: {
      isUnverified: true
    },
  },
  {
    path: '/verify-whatsapp',
    name: 'verify-whatsapp',
    component: Whatsapp,
    meta: {
      isUnverified: true
    },
    props: (route) => ({
      token: route.query.token,
      acceptKey: route.query.acceptKey
    })
  },
  {
    path: '/verify-email',
    name: 'verify-email',
    component: Email,
    meta: {
      isUnverified: true
    },
    props: (route) => ({
      token: route.query.token,
      acceptKey: route.query.acceptKey
    })
  },
  { path: '/sign-up', 
    name: 'sign-up', 
    component: SignUp,
    meta: { 
      isGuest: true 
    } 
  },
  { path: '/login', 
    name: 'login', 
    component: Login,
    meta: { 
      isGuest: true 
    } 
  },
  { path: '/onboarding', 
    name: 'onboarding',
    component: Onboarding,
    meta: { 
      isGuest: true 
    },
    props: (route) => ({
      token: route.query.token,
      candidate: route.query.candidate
    })
  },
  { path: '/forgot-password', 
    name: 'forgot-password', 
    component: ForgotPassword,
  },
  { 
    path: '/reset-password', 
    name: 'reset-password-form', 
    component: ForgotPasswordForm,
    props: (route) => ({
      token: route.query.token,
      email: route.query.email
    })
  },
  {
    path: '/profile',
    name: 'profile',
    component: Profile,
    meta: {
      requiresAuth: true
    },
  },
  {
    path: '/account-management',
    name: 'account-management',
    component: Account,
    meta: {
      requiresAuth: true
    },
  },
  {
    path: '/settings',
    name: 'settings',
    component: Settings,
    meta: {
      requiresAuth: true
    },
  },
  { path: '/:pathMatch(.*)*', 
    name: 'not-found', 
    component: NotFound,
  },
]

export default routes
