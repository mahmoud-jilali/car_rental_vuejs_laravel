<script setup>

import { ref, onMounted } from 'vue'
import { useCarsStore } from '@/stores/cars';
import { useCategoriesStore } from '@/stores/categories'
import { useFuelOptionsStore } from '@/stores/fuelOptions';

const carsStore = useCarsStore()
const carCategoriesStore = useCategoriesStore()
const fuelOptionsStore = useFuelOptionsStore()

const props = defineProps({
  show: Boolean
});
const emit = defineEmits(['close', 'saved'])

onMounted(async () => {
    await carCategoriesStore.getCategories()
    await fuelOptionsStore.getFuelOptions()
})

const car_category = ref('')
const registration_number = ref('')
const brand = ref('')
const model = ref('')
const image = ref('')
const mileage = ref('')
const seats = ref('')
const gearbox = ref('')
const price = ref('')
const fuel = ref('')
const is_available = ref('')
const description = ref('')

const closeModal = () => {
  emit('close')
}

const handleImageChange = (event) => {
  const file = event.target.files[0];
  image.value = file;
}

const addCar = async () => {
    const formData = new FormData();
    formData.append('description', description.value);
    formData.append('car_category_id', car_category.value);
    formData.append('registration_number', registration_number.value);
    formData.append('brand', brand.value);
    formData.append('model', model.value);
    formData.append('image', image.value);
    formData.append('mileage', mileage.value);
    formData.append('seats', seats.value);
    formData.append('gearbox', gearbox.value);
    formData.append('price', price.value);
    formData.append('fuel_options_id', fuel.value);
    formData.append('is_available', is_available.value);
    await carsStore.addCar(formData)
        car_category.value = ''
        description.value = ''
        registration_number.value = ''
        brand.value = ''
        model.value = ''
        image.value = null
        mileage.value = ''
        seats.value = ''
        gearbox.value = ''
        price.value = ''
        fuel.value = ''
        is_available.value = ''
    emit('saved')
    emit('close')
}

</script>

<template>
    <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <form @submit.prevent="addCar">
            <div class="bg-white p-7 rounded-lg shadow-lg w-auto grid gap-2 md:grid-cols-3">
                <div class="mb-1 md:col-span-3">
                    <h2 class="text-2xl font-bold">Add New Car</h2>
                </div>
                <div class="mb-1 col-span-3">
                    <label class="block text-gray-700">Car Category</label>
                    <select v-model="car_category" type="text" class="w-full p-1 border border-gray-300 rounded" required>
                        <option v-for="category in carCategoriesStore.category" :key="category.id" :value="category.name">{{ category.name }}</option>
                    </select>
                </div>
                <div class="mb-1">
                    <label class="block text-gray-700">Registration Number</label>
                    <input v-model="registration_number" type="text" class="w-full p-1 border border-gray-300 rounded" required/>
                </div>
                <div class="mb-1">
                    <label class="block text-gray-700">Brand</label>
                    <input v-model="brand" type="text" class="w-full p-1 border border-gray-300 rounded" required/>
                </div>
                <div class="mb-1">
                    <label class="block text-gray-700">Model</label>
                    <input v-model="model" type="text" class="w-full p-1 border border-gray-300 rounded" required/>
                </div>
                <div class="mb-1">
                    <label class="block text-gray-700">Mileage</label>
                    <input v-model="mileage" type="text" class="w-full p-1 border border-gray-300 rounded" required/>
                </div>
                <div class="mb-1">
                    <label class="block text-gray-700">Seats</label>
                    <input v-model="seats" type="text" class="w-full p-1 border border-gray-300 rounded" required/>
                </div>
                <div class="mb-1">
                    <label class="block text-gray-700">Gearbox</label>
                    <input v-model="gearbox" type="text" class="w-full p-1 border border-gray-300 rounded" required/>
                </div>
                <div class="mb-1">
                    <label class="block text-gray-700">Price</label>
                    <input v-model="price" type="text" class="w-full p-1 border border-gray-300 rounded" required/>
                </div>
                <div class="mb-1">
                    <label class="block text-gray-700">Fuel</label>
                    <select v-model="fuel" type="text" class="w-full p-1 border border-gray-300 rounded" required>
                        <option v-for="fuel in fuelOptionsStore.fuelOption" :key="fuel.id" :value="fuel.name">{{ fuel.name }}</option>
                    </select>
                </div>
                <div class="mb-1">
                    <label class="block text-gray-700">Is Available</label>
                    <input v-model="is_available" type="text" class="w-full p-1 border border-gray-300 rounded" required/>
                </div>
                <div class="mb-1 col-span-3">
                    <label class="block text-gray-700">Image</label>
                    <input v-on:change="handleImageChange" type="file" class="w-full border border-gray-300 rounded" required/>
                </div>
                <div class="mb-1 col-span-3">
                    <label class="block text-gray-700">Description</label>
                    <textarea v-model="description" class="w-full p-1 border border-gray-300 rounded" required></textarea>
                </div>
                <div class="flex justify-end md:col-span-3">
                    <button type="button" @click="closeModal" class="bg-gray-500 text-white px-4 py-1 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Add</button>
                </div>
            </div>
        </form>
    </div>
    
</template>