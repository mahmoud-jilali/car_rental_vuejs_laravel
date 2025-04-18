<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { onMounted } from 'vue'
import { useCarsStore } from '@/stores/cars'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faUsers, faGasPump, faSitemap, faSuitcaseRolling, faGaugeHigh } from '@fortawesome/free-solid-svg-icons'

const carsStore = useCarsStore()
library.add(faUsers, faGasPump, faSitemap, faSuitcaseRolling, faGaugeHigh)

onMounted(async() => {
    await carsStore.getCars()
})

</script>

<template>

    <h1 class="my-14 text-center text-2xl font-bold text-blue-700 uppercase md:text-2xl">Our cars collection</h1>
    <template v-if="carsStore.loading">
        <div role="status">
            <svg class="w-10 h-10 my-7 mx-auto text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </template>
    <template v-else-if="carsStore.cars < 1">
        <div class="text-center">
            <p class="my-5 text-2xl text-red-600">Opps!! No Data</p>
        </div>
    </template>
    <template v-else>
        <div class="flex mx-20 my-7 gap-24">
            <div v-for="car in carsStore.cars" class="block w-1/3 p-6 mx-auto text-center bg-gray-100 border rounded-md cursor-pointer">
                <h5 class="my-3 text-2xl font-bold tracking-tight text-gray-900">{{ car.category.name }}</h5>
                <img :src="car.image" class="h-11/12 w-11/12 my-3 mx-auto" />
                <h6 class="my-3 text-lg font-bold tracking-tight text-gray-900">{{ car.brand }} {{ car.model }}</h6>
                <div class="flex mx-auto grid-cols-4">
                    <div class="flex mx-auto my-3 grid-cols-2">
                        <FontAwesomeIcon icon="users" class="my-2" />
                        <p class="text-1xl my-1 mx-1 text-gray-900">{{ car.seats}} seats</p>
                    </div>
                    <div class="flex mx-auto my-3 grid-cols-2">
                        <FontAwesomeIcon icon="gas-pump" class="my-2" />
                        <p class="text-1xl my-1 mx-1 text-gray-900">{{ car.fuel_option.name }}</p>
                    </div>
                </div>
                <div class="flex mx-auto grid-cols-4">
                    <div class="flex mx-auto my-3 grid-cols-2">
                        <FontAwesomeIcon icon="sitemap" class="my-2" />
                        <p class="text-1xl my-1 mx-1 text-gray-900">{{ car.gearbox }}</p>
                    </div>
                    <div class="flex mx-auto my-3 grid-cols-2">
                        <FontAwesomeIcon icon="gauge-high" class="my-2" />
                        <p class="text-1xl my-1 mx-1 text-gray-900">{{ car.mileage }} KM</p>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <RouterView />
</template>