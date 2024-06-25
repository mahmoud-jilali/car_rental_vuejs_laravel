import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import { adminRouter } from './admin-router'
import Home from '../components/Home/Home.vue'
import About from '../components/About/About.vue'
import Services from '../components/Services/Services.vue'
import Contact from '../components/Contact/Contact.vue'
import Login from '../components/Auth/Login.vue'
import Register from '../components/Auth/Register.vue'
import PasswordForgot from '../components/Auth/PasswordForgot.vue'
import ResetPassword from '../components/Auth/ResetPassword.vue'
import OldRentals from '../components/Rentals/OldRentals.vue'
import CurrentRentals from '../components/Rentals/CurrentRentals.vue'
import NewRentals from '../components/Rentals/NewRentals.vue'
import Information from '../components/Profile/Information.vue'
import Settings from '../components/Profile/Settings.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    ...adminRouter.options.routes,
    {
      path: '/',
      name: 'Home',
      component: Home,
    },
    {
      path: '/about',
      name: 'about',
      component: About,
    },
    {
      path: '/services',
      name: 'services',
      component: Services
    },
    {
      path: '/contact',
      name: 'contact',
      component: Contact
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    },
    {
      path: '/forgot_password',
      name: 'forgot_password',
      component: PasswordForgot
    },
    {
      path: '/reset-password/:token',
      name: 'ResetPassword',
      component: ResetPassword
    },
    {
      path: '/old_rentals',
      name: 'OldRentals',
      component: OldRentals,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/current_rentals',
      name: 'CurrentRentals',
      component: CurrentRentals,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/new_rentals',
      name: 'NewRentals',
      component: NewRentals,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/information',
      name: 'Information',
      component: Information,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/settings',
      name: 'Settings',
      component: Settings,
      meta: {
        requiresAuth: true
      }
    },
  ],
});

  router.beforeEach(async (to, from, next) => {

    const authStore = useAuthStore();
    await authStore.getUser();
    const isAuthenticated = authStore.authUser;

    if (to.matched.some((record) => record.meta.requiresAuth)) {

      if (isAuthenticated) {
        next();
      } else {
        next('/login');
      }
    } else {
      next();
    }
  });

  router.addRoute(adminRouter)

export default router
