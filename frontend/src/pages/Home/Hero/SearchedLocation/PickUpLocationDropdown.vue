<script setup>
import { useLocationsStore } from '@/stores/locations'
import { storeToRefs } from 'pinia'
import { defineProps, defineEmits } from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome' 
import { faLocationDot } from '@fortawesome/free-solid-svg-icons'

library.add(faLocationDot)
const locationsStore = useLocationsStore()
const { locations } = storeToRefs(locationsStore)

const props = defineProps({
    locations: {
        type: Array,
        required: true
    }
})

const emit = defineEmits(['pickup-location-selected'])

const handlePickupLocationClick = (pickUpLocation) => {
    emit('pickup-location-selected', pickUpLocation)
}

</script>

<template>
    <div class="absolute z-10 bg-white shadow-lg rounded-lg w-1/4 mt-40">
        <ul v-if="locations && locations.length > 0" class="py-2">
            <li v-for="location in locations" :key="location.id" class="flex px-2 py-2 hover:bg-gray-300 cursor-pointer"
            @click="handlePickupLocationClick(location)">
                <FontAwesomeIcon icon="location-dot" class="my-1 mx-3" />
                {{ location.street_adress }}, {{ location.city }}
            </li>
        </ul>
        <div v-else class="px-4 py-2">No locations found.</div>
    </div>
</template>