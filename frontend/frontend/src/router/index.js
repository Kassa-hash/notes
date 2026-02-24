import { createRouter, createWebHistory } from "vue-router"
import Login from "../Login.vue"
import Register from "../Register.vue"
import Welcome from "../Welcome.vue"
import AdminDashboard from "../pages/AdminDashboard.vue"
import StudentDashboard from "../pages/StudentDashboard.vue"
import TeacherDashboard from "../pages/TeacherDashboard.vue"

const routes = [
    { path: "/", component: Login },
    { path: "/register", component: Register },
    { path: "/welcome", component: Welcome },
    {
      path: "/admin-dashboard",
      component: AdminDashboard,
      meta: { requiresAuth: true, role: 'admin' }
    },
    {
      path: "/student-dashboard",
      component: StudentDashboard,
      meta: { requiresAuth: true, role: 'etudiant' }
    },
    {
      path: "/teacher-dashboard",
      component: TeacherDashboard,
      meta: { requiresAuth: true, role: 'enseignant' }
    },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

// Route guard for protected routes
router.beforeEach((to, from) => {
  const isAuthenticated = localStorage.getItem("user")
  const userRoles = JSON.parse(localStorage.getItem("roles") || "[]")

  if (to.meta.requiresAuth) {
    if (!isAuthenticated) {
      return "/"
    }

    if (to.meta.role && !userRoles.includes(to.meta.role)) {
      return "/"
    }
  }

  return true
})

export default router
