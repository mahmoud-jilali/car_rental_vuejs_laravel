<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { onMounted } from 'vue'
import { useRentalsStore } from '@/stores/rentals'
import Navbar from '../Navbar/Navbar.vue'
import Footer from '../Footer/Footer.vue'

const rentalsStore = useRentalsStore()

onMounted(async() => {
    await rentalsStore.getNewRentals()
})

</script>

<template>

    <Navbar />

    <h3 class="mt-32 text-center uppercase text-5xl font-extrabold lg:ml-10 text-blue-700 md:text-5xl">Your rentals</h3>
    <nav class="w-auto my-7 mx-28">
        <ul class="flex flex-wrap transition-all duration-300 ease-in-out -mb-px text-sm font-medium text-center" role="tablist">
            <li class="me-2" role="presentation">
                <RouterLink :to="{name: 'OldRentals'}" class="inline-block text-md uppercase p-5 pb-2 rounded-t-lg hover:text-blue-500 hover:border-blue-500 hover:border-b-2" role="tab" aria-selected="false">Old</RouterLink>
            </li>
            <li class="me-2" role="presentation">
                <RouterLink :to="{name: 'CurrentRentals'}" class="inline-block text-md uppercase p-5 pb-2 rounded-t-lg hover:text-blue-500 hover:border-blue-500 hover:border-b-2" role="tab" aria-selected="false">Current</RouterLink>
            </li>
            <li class="me-2" role="presentation">
                <RouterLink :to="{name: 'NewRentals'}" class="inline-block text-md uppercase p-5 pb-2 rounded-t-lg hover:text-blue-500 hover:border-blue-500 hover:border-b-2" role="tab" aria-selected="false">New</RouterLink>
            </li>
        </ul>
    </nav>
    <div class="relative overflow-x-auto">
        <template v-if="rentalsStore.loading">
            <div role="status">
                <svg class="w-10 h-10 my-7 mx-auto text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </template>
        <template v-else-if="rentalsStore.NewRentals">
            <table class="w-5/6 mx-auto text-sm text-left rtl:text-right text-gray-900">
                <thead class="text-xs text-gray-900 border-x uppercase bg-gray-50">
                    <tr>
                        <!-- <th scope="col" class="px-6 py-3">
                            Image
                        </th> -->
                        <th scope="col" class="px-6 py-3">
                            Car
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pick up location
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Drop off location
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Start date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            End date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="rental in rentalsStore.NewRentals" class="bg-white border-b border-x">
                        <!-- <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        
                        </th> -->
                        <td class="px-6 py-4">
                            {{ rental.car.brand }} {{ rental.car.model }}
                        </td>
                        <td class="px-6 py-4">
                            {{ rental.pick_up_location.street_adress }}
                        </td>
                        <td class="px-6 py-4">
                            {{ rental.drop_off_location.street_adress }}
                        </td>
                        <td class="px-6 py-4">
                            {{ rental.start_date }}
                        </td>
                        <td class="px-6 py-4">
                            {{ rental.end_date}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
        <template v-else>
            <div class="bg-blue-100 text-md font-semibold w-1/2 p-7 my-10 mx-auto rounded-md">
                {{ rentalsStore.errors }}
            </div>
        </template>
    </div>

    <Footer  />

<RouterView />
</template>