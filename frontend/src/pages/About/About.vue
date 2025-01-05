<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Navbar from '@/components/Navbar/Navbar.vue'
</script>

<template>

    <Navbar />

    <h1 class="mt-20">About</h1>
    
    <RouterView />
</template>