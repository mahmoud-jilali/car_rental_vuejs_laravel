<script setup>

import { ref, onMounted, watch } from 'vue'
import { useCarsStore } from '@/stores/cars';
import { useCategoriesStore } from '@/stores/categories'
import { useFuelOptionsStore } from '@/stores/fuelOptions';

const carsStore = useCarsStore()
const carCategoriesStore = useCategoriesStore()
const fuelOptionsStore = useFuelOptionsStore()

const props = defineProps({
  show: Boolean,
  car: Object
})
const emit = defineEmits(['close', 'updated'])

const car = ref({ ...props.car })

watch(() => props.car, (newCar) => {
  car.value = { ...newCar };
})

onMounted(async () => {
    await carCategoriesStore.getCategories()
    await fuelOptionsStore.getFuelOptions()
})

const closeModal = () => {
  emit('close')
}

const handleImageChange = (event) => {
  const file = event.target.files[0];
  car.value.image = file;
}

const updateCar = async () => {
   const carData = new FormData();
    carData.append('id', car.value.id);
    carData.append('car_category_id', car.value.car_category_id);
    carData.append('registration_number', car.value.registration_number);
    carData.append('brand', car.value.brand);
    carData.append('model', car.value.model);
    carData.append('mileage', car.value.mileage);
    carData.append('seats', car.value.seats);
    carData.append('gearbox', car.value.gearbox);
    carData.append('price', car.value.price);
    carData.append('fuel_options_id', car.value.fuel_options_id);
    carData.append('is_available', car.value.is_available);
    carData.append('description', car.value.description);

    if (car.value.image) {
        carData.append('image', car.value.image);
    }
    
    try {
        const response = await carsStore.updateCar(car.value.id, car.value);
        emit('updated');
        emit('close');
    } catch (error) {
        console.error(error);
    }
}

</script>

<template>
    <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <form @submit.prevent="updateCar">
            <div class="bg-white p-7 rounded-lg shadow-lg w-auto grid gap-2 md:grid-cols-3">
                <div class="mb-4 md:col-span-3">
                    <h2 class="text-2xl font-bold">Edit Car</h2>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Car Category</label>
                    <select v-model="car.car_category_id" type="text" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                        <option v-for="category in carCategoriesStore.category" :key="category.id" :value="category.name">{{ category.name }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Registration Number</label>
                    <input v-model="car.registration_number" type="text" class="w-full p-2 border border-gray-300 rounded mt-1" required/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Brand</label>
                    <input v-model="car.brand" type="text" class="w-full p-2 border border-gray-300 rounded mt-1" required/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Model</label>
                    <input v-model="car.model" type="text" class="w-full p-2 border border-gray-300 rounded mt-1" required/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Image</label>
                    <input v-on:change="handleImageChange" type="file" class="w-full p-1 border border-gray-300 rounded mt-1" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Mileage</label>
                    <input v-model="car.mileage" type="text" class="w-full border border-gray-300 rounded" required/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Seats</label>
                    <input v-model="car.seats" type="text" class="w-full p-2 border border-gray-300 rounded mt-1" required/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Gearbox</label>
                    <input v-model="car.gearbox" type="text" class="w-full p-2 border border-gray-300 rounded mt-1" required/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Price</label>
                    <input v-model="car.price" type="text" class="w-full p-2 border border-gray-300 rounded mt-1" required/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Fuel</label>
                    <select v-model="car.fuel_options_id" type="text" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                        <option v-for="fuel in fuelOptionsStore.fuelOption" :key="fuel.id" :value="fuel.name">{{ fuel.name }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Is Available</label>
                    <input v-model="car.is_available" type="text" class="w-full p-2 border border-gray-300 rounded mt-1" required/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Description</label>
                    <textarea v-model="car.description" class="w-full p-2 border border-gray-300 rounded mt-1" required></textarea>
                </div>
                <div class="flex justify-end md:col-span-3">
                    <button type="button" @click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Edit</button>
                </div>
            </div>
        </form>
    </div>
    
</template>