<script setup>

import { ref } from 'vue';
import { useLocationsStore } from '@/stores/locations';

const props = defineProps({
  show: Boolean
});
const emit = defineEmits(['close', 'saved']);

const country = ref('');
const city = ref('');
const state = ref('');
const zip_code = ref('');
const street_adress = ref('');
const locationsStore = useLocationsStore();

const closeModal = () => {
  emit('close');
};

const addLocation = async () => {
  await locationsStore.addLocation({ country: country.value, city: city.value, state: state.value, 
    zip_code: zip_code.value, street_adress: street_adress.value });
    country.value = '';
    city.value = '';
    state.value = '';
    zip_code.value = '';
    street_adress.value = '';
  emit('saved');
  emit('close');
};

</script>

<template>
  <div
    v-if="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-2xl font-bold mb-4">Add New Location</h2>
      <form @submit.prevent="addLocation">
        <div class="mb-4">
          <label class="block text-gray-700">Country</label>
          <input
            v-model="country"
            type="text"
            class="w-full p-2 border border-gray-300 rounded mt-1" required/>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">City</label>
          <input
            v-model="city"
            type="text"
            class="w-full p-2 border border-gray-300 rounded mt-1" required/>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">State</label>
          <input
            v-model="state"
            type="text"
            class="w-full p-2 border border-gray-300 rounded mt-1" required/>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Zip Code</label>
          <input
            v-model="zip_code"
            type="text"
            class="w-full p-2 border border-gray-300 rounded mt-1" required/>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Street Adress</label>
          <textarea
            v-model="street_adress"
            class="w-full p-2 border border-gray-300 rounded mt-1"
            required
          ></textarea>
        </div>
        <div class="flex justify-end">
          <button
            type="button"
            @click="closeModal"
            class="bg-gray-500 text-white px-4 py-2 rounded mr-2"
          >
            Cancel
          </button>
          <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded" >
            Add
          </button>
        </div>
      </form>
    </div>
  </div>
</template>