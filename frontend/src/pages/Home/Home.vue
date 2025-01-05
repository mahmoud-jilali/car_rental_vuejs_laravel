<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Navbar from '@/components/Navbar/Navbar.vue'
import HeroSection from './Hero/HeroSection.vue'
import Services from './Services/Services.vue'
import Cars from './Cars/Cars.vue'
import Footer from '@/components/Footer/Footer.vue'

</script>

<template>
    <Navbar />

    <HeroSection />

    <Services />

    <Cars />

    <Footer />

    <RouterView />
</template>