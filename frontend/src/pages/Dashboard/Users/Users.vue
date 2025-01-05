<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { ref, onMounted } from 'vue';
import SidebarNav from '@/components/SidebarNav/SidebarNav.vue'

</script>

<template>
    <div class="flex">
        <SidebarNav />
        <h1 class="mt-20 mx-auto">Users</h1>
    </div>


    <RouterView />
</template>