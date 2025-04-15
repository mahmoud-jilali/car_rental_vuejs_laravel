<script setup>
import { ref, watch } from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faUsers, faGasPump, faSitemap, faSuitcaseRolling, faGaugeHigh, 
    faCar, faMoneyBill, faCheck, faInfo } from '@fortawesome/free-solid-svg-icons'

library.add(faUsers, faGasPump, faSitemap, faSuitcaseRolling, 
    faGaugeHigh, faCar, faMoneyBill, faCheck, faInfo)

const props = defineProps({
  show: Boolean,
  car: Object,
});

const emit = defineEmits(['close', 'view']);

const car = ref({ ...props.car });

watch(() => props.car, (newCar) => {
  car.value = { ...newCar };
});

const closeModal = () => {
  emit('close');
};

const getCar = async (carId) => {
  try {
    await new Promise((resolve) => setTimeout(resolve, 500))
    emit('view')
    emit('close')
  } catch (error) {
    console.error('Error fetching car:', error);
  }
};
</script>

<template>
  <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-gray-200 p-7 rounded-lg shadow-lg w-1/2">
      <h5 class="text-2xl font-bold tracking-tight text-gray-900 text-center">{{ car?.category?.name }}</h5>
      <img :src="car?.image" class="h-52 w-96 my-3 mx-auto" />
      <h6 class="my-3 text-lg font-bold tracking-tight text-gray-900 text-center">{{ car?.brand }} {{ car?.model }}</h6>
      <div class="flex mx-auto grid-cols-3">
            <div class="flex mx-auto my-1 grid-cols-2">
                <FontAwesomeIcon icon="car" class="my-2 mx-2" />
                <p class="text-1xl my-1 mx-1 text-gray-900">{{ car?.registration_number}}</p>
            </div>
            <div class="flex mx-auto my-1 grid-cols-2">
                <FontAwesomeIcon icon="gas-pump" class="my-2 mx-2" />
                <p class="text-1xl my-1 mx-1 text-gray-900">{{ car?.fuel_option?.name }}</p>
            </div>
            <div class="flex mx-auto my-1 grid-cols-2">
                <FontAwesomeIcon icon="sitemap" class="my-2 mx-2" />
                <p class="text-1xl my-1 mx-1 text-gray-900">{{ car?.gearbox }}</p>
            </div>
        </div>
        <div class="flex mx-auto grid-cols-3">
            <div class="flex mx-auto my-1 grid-cols-2">
                <FontAwesomeIcon icon="gauge-high" class="my-2 mx-2" />
                <p class="text-1xl my-1 mx-1 text-gray-900">{{ car?.mileage }} KM</p>
            </div>
            <div class="flex mx-auto my-1 grid-cols-2">
                <FontAwesomeIcon icon="money-bill" class="my-2 mx-2" />
                <p class="text-1xl my-1 mx-1 text-gray-900">{{ car?.price }} MAD</p>
            </div>
            <div class="flex mx-auto my-1 grid-cols-2">
                <FontAwesomeIcon icon="check" class="my-2 mx-2" />
                <p class="text-1xl my-1 mx-1 text-gray-900">{{ car?.is_available }}</p>
            </div>
        </div>
        <div class="text-center mt-2">
            <FontAwesomeIcon icon="info" class="my-2 mx-2" />
            <p class="text-1xl my-1 mx-1 text-gray-900">{{ car?.description }}</p>
        </div>
      <button @click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Close</button>
    </div>
  </div>
</template>