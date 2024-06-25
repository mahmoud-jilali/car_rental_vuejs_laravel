<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Navbar from '../Navbar/Navbar.vue'
import Footer from '../Footer/Footer.vue'

</script>

<template>
    <Navbar />

    <h3 class="mt-32 text-center uppercase text-5xl font-extrabold lg:ml-10 text-blue-700 md:text-5xl">Your profile</h3>
    <nav class="w-auto my-7 mx-28">
        <ul class="flex flex-wrap transition-all duration-300 ease-in-out -mb-px text-sm font-medium text-center" role="tablist">
            <li class="me-2" role="presentation">
                <RouterLink :to="{name: 'Information'}" class="inline-block text-md uppercase p-5 pb-2 rounded-t-lg hover:text-blue-500 hover:border-blue-500 hover:border-b-2" role="tab" aria-selected="false">Information</RouterLink>
            </li>
            <li class="me-2" role="presentation">
                <RouterLink :to="{name: 'Settings'}" class="inline-block text-md uppercase p-5 pb-2 rounded-t-lg hover:text-blue-500 hover:border-blue-500 hover:border-b-2" role="tab" aria-selected="false">Settings</RouterLink>
            </li>
        </ul>
    </nav>


    <Footer />

<RouterView />
</template>