<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { ref, onMounted } from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faHome, faCar, faList, faAddressCard, faGasPump, faCarBurst, faLocationDot, faFileInvoice, faInfo, faUsers} from '@fortawesome/free-solid-svg-icons'


library.add(faHome, faCar, faList, faAddressCard, faGasPump, faCarBurst, faLocationDot, faFileInvoice, faInfo, faUsers)


</script>

<template>
    

<nav class="fixed top-0 z-50 w-full bg-blue-300 border-b border-gray-200">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400  dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <RouterLink :to="{name: 'AdminDashboard'}" class="flex ms-2 md:me-24">
          <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" /> -->
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">CARS RENT</span>
        </RouterLink>
      </div>
      <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
              </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
              <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                  Neil Sims
                </p>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                  neil.sims@flowbite.com
                </p>
              </div>
              <ul class="py-1" role="none">
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Earnings</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-56 h-screen pt-20 transition-transform -translate-x-full bg-blue-500 border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full w-auto pb-4 overflow-y-auto bg-blue-500">
      <ul class="space-y-2 font-medium">
         <li>
            <RouterLink :to="{name: 'AdminDashboard'}" class="flex items-center p-2 w-auto text-white rounded-l-md hover:bg-white hover:text-blue-500 group">
               <FontAwesomeIcon icon="home" class="mx-2 py-1 cursor-pointer text-black" />
               <span class="ms-3">Dashboard</span>
            </RouterLink>
         </li>
         <li>
            <RouterLink :to="{name: 'Cars'}" class="flex items-center p-2 w-auto text-white rounded-l-md hover:bg-white hover:text-blue-500 group">
               <FontAwesomeIcon icon="car" class="mx-2 py-1 cursor-pointer text-black" />
               <span class="flex-1 ms-3 whitespace-nowrap">Cars</span>
            </RouterLink>
         </li>
         <li>
            <RouterLink :to="{name: 'Categories'}" class="flex items-center p-2 w-auto text-white rounded-l-md hover:bg-white hover:text-blue-500 group">
               <FontAwesomeIcon icon="list" class="mx-2 py-1 cursor-pointer text-black" />
               <span class="flex-1 ms-3 whitespace-nowrap">Categories</span>
            </RouterLink>
         </li>
         <li>
            <RouterLink :to="{name: 'Customers'}" class="flex items-center p-2 w-auto text-white rounded-l-md hover:bg-white hover:text-blue-500 group">
               <FontAwesomeIcon icon="address-card" class="mx-2 py-1 cursor-pointer text-black" />
               <span class="flex-1 ms-3 whitespace-nowrap">Customers</span>
            </RouterLink>
         </li>
         <li>
            <RouterLink :to="{name: 'FuelOptions'}" class="flex items-center p-2 w-auto text-white rounded-l-md hover:bg-white hover:text-blue-500 group">
               <FontAwesomeIcon icon="gas-pump" class="mx-2 py-1 cursor-pointer text-black" />
               <span class="flex-1 ms-3 whitespace-nowrap">Fuel Options</span>
            </RouterLink>
         </li>
         <li>
            <RouterLink :to="{name: 'Insurances'}" class="flex items-center p-2 w-auto text-white rounded-l-md hover:bg-white hover:text-blue-500 group">
               <FontAwesomeIcon icon="car-burst" class="mx-2 py-1 cursor-pointer text-black" />
               <span class="flex-1 ms-3 whitespace-nowrap">Insurances</span>
            </RouterLink>
         </li>
         <li>
            <RouterLink :to="{name: 'Locations'}" class="flex items-center p-2 w-auto text-white rounded-l-md hover:bg-white hover:text-blue-500 group">
               <FontAwesomeIcon icon="location-dot" class="mx-2 py-1 cursor-pointer text-black" />
               <span class="flex-1 ms-3 whitespace-nowrap">Locations</span>
            </RouterLink>
         </li>
         <li>
            <RouterLink :to="{name: 'Rentals'}" class="flex items-center p-2 w-auto text-white rounded-l-md hover:bg-white hover:text-blue-500 group">
               <FontAwesomeIcon icon="file-invoice" class="mx-2 py-1 cursor-pointer text-black" />
               <span class="flex-1 ms-3 whitespace-nowrap">Rentals</span>
            </RouterLink>
         </li>
         <li>
            <RouterLink :to="{name: 'Services'}" class="flex items-center p-2 w-auto text-white rounded-l-md hover:bg-white hover:text-blue-500 group">
               <FontAwesomeIcon icon="info" class="mx-2 py-1 cursor-pointer text-black" />
               <span class="flex-1 ms-3 whitespace-nowrap">Services</span>
            </RouterLink>
         </li>
         <li>
            <RouterLink :to="{name: 'Users'}" class="flex items-center p-2 w-auto text-white rounded-l-md hover:bg-white hover:text-blue-500 group">
               <FontAwesomeIcon icon="users" class="mx-2 py-1 cursor-pointer text-black" />
               <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
            </RouterLink>
         </li>
      </ul>
   </div>
</aside>

<div class="p-4 sm:ml-64">
   
</div>


<RouterView />
</template>