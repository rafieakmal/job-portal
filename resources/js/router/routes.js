import ContactPage from '../src/pages/ContactPage'
import HomePage from '../src/pages/HomeComponent'
import NotFound from '../src/pages/NotFoundComponent.vue'
import SignUp from '../src/pages/SignUpComponent.vue'
import Login from '../src/pages/LoginComponent.vue'
import ForgotPassword from '../src/pages/ForgotPasswordComponent.vue'
import ForgotPasswordForm from '../src/components/signup/ForgotPasswordForm.vue'
import Onboarding  from '../src/components/signup/Onboarding.vue'
import VerifyPage from '../src/pages/VerifyPage.vue'
import JobDetailPage from '../src/pages/DetailPage.vue'
import Profile from '../src/components/profile/Profile.vue'
import Account from '../src/components/profile/Account.vue'
import Settings from '../src/components/profile/Settings.vue'
import Whatsapp from '../src/pages/WhatsappPage.vue'
import EditProfile from '../src/pages/EditProfilePage.vue'
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
    path: "/job-detail/:slug",
    component: JobDetailPage,
    name: 'job-detail',
    meta: {
      requiresAuth: true
    }
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
    path: "/user",
    component: EditProfile,
    name: 'profile-main',
    meta: {
      requiresAuth: true
    },
    children: [{
        path: 'profile',
        meta: {
          requiresAuth: true
        },
        component: Profile,
        name: 'profile-edit'
      },
      {
        path: 'settings',
        component: Settings,
        name: 'profile-settings'
      },
      {
        path: 'account-management',
        component: Account,
        name: 'profile-management'
      },
    ]
  },
  { path: '/:pathMatch(.*)*', 
    name: 'not-found', 
    component: NotFound,
  },
]

export default routes
