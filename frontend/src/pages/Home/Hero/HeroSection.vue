<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { ref, watch } from 'vue'
import { useLocationsStore } from '@/stores/locations'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faSearch, faCalendarAlt, faLocationDot } from '@fortawesome/free-solid-svg-icons'
import Datepicker from 'vue3-datepicker'
import PickUpLocationDropdown from './SearchedLocation/PickUpLocationDropdown.vue'
import DropOffLocationDropdown from './SearchedLocation/DropOffLocationDropdown.vue'


const locationsStore = useLocationsStore()
library.add(faSearch, faCalendarAlt, faLocationDot)

const dropOffLocationInput = ref(false)
const startDate = ref(null)
const endDate = ref(null)
const showPickupDropdown = ref(false)
const showDropoffDropdown = ref(false)
const pickupLocation = ref('')
const dropoffLocation = ref('')

const showDropOffLocation = () => {
    dropOffLocationInput.value = !dropOffLocationInput.value
}

const searchPickUpLocation = async (event) => {
    const keyword = event.target.value
    locationsStore.getPickUpSearchedLocation(keyword)
    showPickupDropdown.value = true
}

const searchDropOffLocation = async (event) => {
    const keyword = event.target.value
    locationsStore.getDropOffSearchedLocation(keyword)
    showDropoffDropdown.value = true
}

watch(() => locationsStore.locations, (locations) => {
    if (locations && locations.length === 0) {
        showPickupDropdown.value = false
        showDropoffDropdown.value = false
    }
})

const handlePickUpLocationSelected = (location) => {
     if(pickupLocation.value) {
        pickupLocation.value = `${location.street_adress}, ${location.city}`
    }
    showPickupDropdown.value = false;
}

const handleDropOffLocationSelected = (location) => {
     if(dropoffLocation.value) {
        dropoffLocation.value = `${location.street_adress}, ${location.city}`
    }
    showDropoffDropdown.value = false;
}

</script>

<template>
    <section class="bg-blue-50 mt-16 max-w-auto">
        <div class="grid max-w-screen-xl px-4 py-5 mx-auto lg:gap-8 xl:gap-0 lg:py-7 lg:grid-cols-12">
            <div class="mx-auto place-self-left lg:col-span-7">
                <h1 class="my-14 text-left text-7xl font-extrabold lg:ml-10 tracking-tight text-blue-700 leading-none md:text-7xl">CAR RENTAL DELIVERED AT HOME</h1>
                <p class="text-left my-10 text-3xl font-medium text-gray-800 lg:ml-10 lg:mb-8 md:text-3xl">We deliver and pick up your rental car at the address of your choice.</p>
            </div>
            <div class="hidden lg:mt-0 lg:px-10 lg:col-span-5 lg:flex">
                <div class="mx-7 my-7 z-10">
                    <img src="https://cdn-icons-png.flaticon.com/256/7891/7891893.png" alt="">
                </div>
                <div class="absolute mt-32 ml-44 z-10 sm:h-auto">
                    <img src="https://content.avito.ma/autoneuf/images/26/26427637-1307-4a4c-b70b-a96ae0199850?t=model_320_320" alt="">
                </div>
            </div>
        </div>
        <form>
            <div class="flex md:grid-cols-5 bg-blue-100 border mx-auto items-center w-5/6 my-1 rounded-full">
                <div class="flex items-center ml-7 w-full border-r-2 border-black">
                    <FontAwesomeIcon icon="location-dot" class="my-2" />
                    <input @input="searchPickUpLocation" v-model="pickupLocation"
                    type="text" class="bg-transparent text-gray-900 text-sm p-2 border-none focus:ring-transparent focus:border-transparent" placeholder="Pick-Up location" />
                    <PickUpLocationDropdown v-if="showPickupDropdown" :locations="locationsStore.locations"
                    @pickup-location-selected="handlePickUpLocationSelected" class="mt-28"/>
                </div>
                <div v-if="dropOffLocationInput" class="flex items-center ml-7 w-full border-r-2 border-black">
                    <FontAwesomeIcon icon="location-dot" class="my-2" />
                    <input @input="searchDropOffLocation" v-model="dropoffLocation"
                    type="text" class="bg-transparent text-gray-900 text-sm p-2 border-none focus:ring-transparent focus:border-transparent" placeholder="Drop-Off location" />
                    <DropOffLocationDropdown v-if="showDropoffDropdown" :locations="locationsStore.locations"
                    @dropoff-location-selected="handleDropOffLocationSelected" class="mt-28"/>
                </div>
                <div class="flex items-center ml-7 w-1/6 border-r-2 border-black">
                    <FontAwesomeIcon icon="calendar-alt" class="my-2" />
                    <Datepicker v-model="startDate" class="bg-transparent text-gray-900 text-sm p-2 border-none focus:ring-transparent focus:border-transparent" placeholder="Start date" />
                </div>
                <div class="flex items-center ml-7 w-1/6">
                    <FontAwesomeIcon icon="calendar-alt" class="my-2" />
                    <Datepicker v-model="endDate" class="bg-transparent text-gray-900 text-sm p-2 border-none focus:ring-transparent focus:border-transparent" placeholder="End date" />
                </div>
                <div class="my-auto py-4 mx-1">
                    <RouterLink :to="{name: ''}" class="text-blue-600 hover:text-blue-800 font-medium text-3xl"><FontAwesomeIcon icon="search" class="px-2"/></RouterLink>
                </div>
            </div>
            <label class="inline-flex mx-40 my-1 items-center cursor-pointer">
                <input type="checkbox" value="" class="sr-only peer">
                <div @click="showDropOffLocation" class="relative w-9 h-5 bg-blue-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-500"></div>
                <span class="ms-3 text-sm font-medium text-gray-900">Drop off car at different location</span>
            </label>
        </form>
    </section>
    <!-- <LocationsDropdown v-if="showDropoffDropdown  && (pickupLocation || dropoffLocation) " :locations="locationsStore.locations"/> -->
    <RouterView />
</template>