import { createRouter, createWebHistory } from "vue-router"
import Login from "../Login.vue"
import Register from "../Register.vue"
import Welcome from "../Welcome.vue"
const routes = [
    { path: "/", component: Login },
    { path: "/register", component: Register },
    { path: "/welcome", component: Welcome },

]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
