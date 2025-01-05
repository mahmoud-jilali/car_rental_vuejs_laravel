<script setup>
import { RouterLink, RouterView } from 'vue-router'

</script>

<template>

    <h1 class="my-14 text-center text-2xl font-bold text-blue-700 uppercase md:text-2xl">We offer the best services</h1>
    <div class="flex mx-20 my-7 gap-24">
        <div class="block max-w-sm p-6 mx-auto text-center bg-white">
            <img src="https://cdn-icons-png.flaticon.com/512/6556/6556055.png" class="size-20 mb-8 mx-auto" />
            <h5 class="mb-8 text-1xl font-bold tracking-tight text-gray-900">Delivery and recovery 7d/7</h5>
            <p class="font-normal text-gray-700">We deliver and collect your vehicle, at the time and address of your choice, 7 days a week from 8 a.m. to 11 p.m.</p>
        </div>
        <div class="block max-w-sm p-6 mx-auto text-center bg-white">
            <img src="https://cdn-icons-png.freepik.com/512/8643/8643852.png" class="size-20 mb-8 mx-auto" />
            <h5 class="mb-8 text-1xl font-bold tracking-tight text-gray-900">We are at your service</h5>
            <p class="font-normal text-gray-700">Our Customer Service is at your disposal 7 days a week from 8 a.m to 8 p.m, even on public holidays.</p>
        </div>
        <div class="block max-w-sm p-6 mx-auto text-center bg-white">
            <img src="https://cdn-icons-png.flaticon.com/512/7061/7061954.png" class="size-20 mb-8 mx-auto" />
            <h5 class="mb-8 text-1xl font-bold tracking-tight text-gray-900">Reservation editable</h5>
            <p class="font-normal text-gray-700">Modify your reservation at any time, directly in your account. Even for a current rental.</p>
        </div>
        <div class="block max-w-sm p-6 mx-auto text-center bg-white">
            <img src="https://cdn-icons-png.flaticon.com/512/4524/4524884.png" class="size-20 mb-8 mx-auto" />
            <h5 class="mb-8 text-1xl font-bold tracking-tight text-gray-900">Cancelation free</h5>
            <p class="font-normal text-gray-700">Cancel your rental free of charge up to 24 hours before the start of the rental.</p>
        </div>
    </div>
    <div class="block max-w-sm mx-auto text-center">
        <RouterLink  :to="{name: 'services'}" class="text-white bg-black hover:bg-white hover:text-black hover:border border-black font-medium rounded-lg text-lg px-4 py-2 text-center">Learn more</RouterLink>
    </div>

    <RouterView />
</template>