import VueRouter from 'vue-router'
import routes from './routes'

const router = new VueRouter({
    mode: 'history',
    routes,
    linkExactActiveClass: "active",
})

const originalPush = VueRouter.prototype.push
VueRouter.prototype.push = function push(location) {
    return originalPush.call(this, location).catch((error) => {})
}

export default router