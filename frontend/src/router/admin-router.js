import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import AdminDashboard from '@/pages/Dashboard/Home/DashboardHome.vue'
import Categories from '@/pages/Dashboard/Categories/Categories.vue'
import Cars from '@/pages/Dashboard/Cars/Cars.vue'
import Customers from '@/pages/Dashboard/Customers/Customers.vue'
import FuelOptions from '@/pages/Dashboard/FuelOptions/FuelOptions.vue'
import Insurances from '@/pages/Dashboard/Insurances/Insurances.vue'
import Locations from '@/pages/Dashboard/Locations/Locations.vue'
import Rentals from '@/pages/Dashboard/Rentals/Rentals.vue'
import Services from '@/pages/Dashboard/Services/Services.vue'
import Users from '@/pages/Dashboard/Users/Users.vue'

const adminRouter = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin/dashboard',
      name: 'AdminDashboard',
      component: AdminDashboard,
      // meta: {
      //   requiresAuth: true
      // }
    },
    {
      path: '/admin/categories',
      name: 'Categories',
      component: Categories,
      // meta: {
      //   requiresAuth: true
      // }
    },
    {
      path: '/admin/cars',
      name: 'Cars',
      component: Cars,
      // meta: {
      //   requiresAuth: true
      // }
    },
    {
      path: '/admin/customers',
      name: 'Customers',
      component: Customers,
      // meta: {
      //   requiresAuth: true
      // }
    },
    {
      path: '/admin/fuel_options',
      name: 'FuelOptions',
      component: FuelOptions,
      // meta: {
      //   requiresAuth: true
      // }
    },
    {
      path: '/admin/insurances',
      name: 'Insurances',
      component: Insurances,
      // meta: {
      //   requiresAuth: true
      // }
    },
    {
      path: '/admin/locations',
      name: 'Locations',
      component: Locations,
      // meta: {
      //   requiresAuth: true
      // }
    },
    {
      path: '/admin/rentals',
      name: 'Rentals',
      component: Rentals,
      // meta: {
      //   requiresAuth: true
      // }
    },
    {
      path: '/admin/services',
      name: 'Services',
      component: Services,
      // meta: {
      //   requiresAuth: true
      // }
    },
    {
      path: '/admin/users',
      name: 'Users',
      component: Users,
      // meta: {
      //   requiresAuth: true
      // }
    },
  ]
});

// adminRouter.beforeEach(async (to, from, next) => {

//     const authStore = useAuthStore();
//     await authStore.getUser();
//     const isAuthenticated = authStore.authUser;

//     if (to.matched.some((record) => record.meta.requiresAuth)) {

//       if (isAuthenticated) {
//         next();
//       } else {
//         next('/login');
//       }
//     } else {
//       next();
//     }
//   });

export { adminRouter }
