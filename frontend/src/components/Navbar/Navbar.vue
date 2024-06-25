<script setup>

import { RouterLink, RouterView } from 'vue-router'
import { ref, onMounted } from 'vue';
import { useAuthStore } from '../../stores/auth'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faUser } from '@fortawesome/free-regular-svg-icons'
import { faChevronDown } from '@fortawesome/free-solid-svg-icons';

library.add(faUser, faChevronDown)

const authStore = useAuthStore()
const dropDown = ref(false);

const showDropDown = () => {
  dropDown.value = !dropDown.value
}

onMounted(async() => {
  await authStore.getUser()
})

</script>

<template>
  <nav class="bg-blue-50 fixed w-full z-20 top-0 start-0">
    <div class="border-b my-3 border-blue-50 max-w-screen-full flex flex-wrap items-center justify-between">
      <RouterLink to="/" class="flex items-center space-x-3 rtl:space-x-reverse mx-7">
      <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo"> -->
      <span class="text-blue-600 self-center text-2xl font-semibold whitespace-nowrap">Car Rental</span>
      </RouterLink>
      <div class="flex mx-7 md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
        <template v-if="!authStore.user">
          <RouterLink :to="{name: 'login'}" class="text-white bg-blue-500 hover:bg-white hover:text-blue-500 hover:border border-blue-500 font-medium rounded-lg text-sm mx-4 px-4 py-2 mt-4 text-center">Log In</RouterLink>
          <RouterLink  :to="{name: 'register'}" class="text-white bg-black hover:bg-white hover:text-black hover:border border-black font-medium rounded-lg text-sm mx-4 px-4 py-2 mt-4 text-center">Sign Up</RouterLink>
        </template>
        <template v-else>
          <button @click="showDropDown" class="text-black bg-transparent right-auto font-medium w-auto rounded-lg text-sm px-5 mt-2 text-center inline-flex items-center" type="button">
            <FontAwesomeIcon icon="fa-regular fa-user" class="mx-2" />
            Welcome {{ authStore.user.first_name }} {{ authStore.user.last_name }}
            <FontAwesomeIcon icon="chevron-down" class="mx-2" />
          </button>
          <div v-if="dropDown" class="absolute z-10 top-16 right-16 bg-white divide-y divide-gray-100 rounded-lg shadow w-auto">
            <p class="px-4 py-2">{{ authStore.user.email }}</p>
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
              <li>
                <RouterLink :to="{name: 'Information'}" class="block px-4 py-2 hover:bg-blue-50">Profil</RouterLink>
              </li>
              <li>
                <RouterLink :to="{name: 'OldRentals'}" class="block px-4 py-2 hover:bg-blue-50">Rentals</RouterLink>
              </li>
              <li>
                <RouterLink :to="{name: 'Home'}" @click="authStore.logout" class="block px-4 py-2 hover:bg-blue-50">Log out</RouterLink>
              </li>
            </ul>
          </div>
        </template>
      </div>
      <ul class="flex flex-wrap transition-all duration-300 ease-in-out -mb-px text-sm font-medium text-center" role="tablist">
        <li class="me-2" role="presentation">
            <RouterLink to="/" class="inline-block border-blue-50 p-5 pb-2 border-b-2 rounded-t-lg hover:text-blue-500 hover:border-blue-500" role="tab" aria-selected="false">Home</RouterLink>
        </li>
        <li class="me-2" role="presentation">
            <RouterLink to="/about" class="inline-block border-blue-50 p-5 pb-2 border-b-2 rounded-t-lg hover:text-blue-500 hover:border-blue-500" role="tab" aria-selected="false">About</RouterLink>
        </li>
        <li class="me-2" role="presentation">
            <RouterLink to="/services" class="inline-block border-blue-50 p-5 pb-2 border-b-2 rounded-t-lg hover:text-blue-500 hover:border-blue-500" role="tab" aria-selected="false">Services</RouterLink>
        </li>
        <li role="presentation">
            <RouterLink to="/contact" class="inline-block border-blue-50 p-5 pb-2 border-b-2 rounded-t-lg hover:text-blue-500 hover:border-blue-500" role="tab" aria-selected="false">Contact</RouterLink>
        </li>
      </ul>
    </div>
  </nav>
<RouterView />
</template>
