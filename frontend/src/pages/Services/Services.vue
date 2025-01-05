<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Navbar from '@/components/Navbar/Navbar.vue'
import Footer from '@/components/Footer/Footer.vue'
</script>

<template>
    
    <Navbar />

    <h1 class="mt-20">Services</h1>


    <Footer />

    <RouterView />
</template>