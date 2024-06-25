import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import AdminDashboard from '@/components/Dashboard/Home/DashboardHome.vue'
import Categories from '@/components/Dashboard/Categories/Categories.vue'
import Cars from '@/components/Dashboard/Cars/Cars.vue'
import Customers from '@/components/Dashboard/Customers/Customers.vue'
import FuelOptions from '@/components/Dashboard/FuelOptions/FuelOptions.vue'
import Insurances from '@/components/Dashboard/Insurances/Insurances.vue'
import Locations from '@/components/Dashboard/Locations/Locations.vue'
import Rentals from '@/components/Dashboard/Rentals/Rentals.vue'
import Services from '@/components/Dashboard/Services/Services.vue'
import Users from '@/components/Dashboard/Users/Users.vue'

import CategorieCreate from '@/components/Dashboard/Categories/CategorieCreate.vue'
import CarCreate from '@/components/Dashboard/Cars/CarCreate.vue'
import FuelOptionCreate from '@/components/Dashboard/FuelOptions/FuelOptionCreate.vue'
import InsuranceCreate from '@/components/Dashboard/Insurances/InsuranceCreate.vue'
import LocationCreate from '@/components/Dashboard/Locations/LocationCreate.vue'

const adminRouter = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin/dashboard',
      name: 'AdminDashboard',
      component: AdminDashboard,
    },
    {
      path: '/admin/categories',
      name: 'Categories',
      component: Categories,
    },
    {
      path: '/admin/cars',
      name: 'Cars',
      component: Cars,
    },
    {
      path: '/admin/customers',
      name: 'Customers',
      component: Customers,
    },
    {
      path: '/admin/fuel_options',
      name: 'FuelOptions',
      component: FuelOptions,
    },
    {
      path: '/admin/insurances',
      name: 'Insurances',
      component: Insurances,
    },
    {
      path: '/admin/locations',
      name: 'Locations',
      component: Locations,
    },
    {
      path: '/admin/rentals',
      name: 'Rentals',
      component: Rentals,
    },
    {
      path: '/admin/services',
      name: 'Services',
      component: Services,
    },
    {
      path: '/admin/users',
      name: 'Users',
      component: Users,
    },
    {
      path: '/admin/car/create',
      name: 'CarCreate',
      component: CarCreate,
    },
    {
      path: '/admin/categorie/create',
      name: 'CategorieCreate',
      component: CategorieCreate,
    },
    {
      path: '/admin/fuel_option/create',
      name: 'FuelOptionCreate',
      component: FuelOptionCreate,
    },
    {
      path: '/admin/insurance/create',
      name: 'InsuranceCreate',
      component: InsuranceCreate,
    },
    {
      path: '/admin/location/create',
      name: 'LocationCreate',
      component: LocationCreate,
    },
  ]
});

export { adminRouter }
