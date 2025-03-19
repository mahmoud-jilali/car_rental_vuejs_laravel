<script setup>

import { ref, watch } from 'vue';
import { useLocationsStore } from '@/stores/locations';

const props = defineProps({
  show: Boolean,
  location: Object
});
const emit = defineEmits(['close', 'updated'])

const locationsStore = useLocationsStore()
const location = ref({ ...props.location })

watch(() => props.location, (newLocation) => {
  location.value = { ...newLocation };
});

const updateLocation = async () => {
  await locationsStore.updateLocation(location.value);
  emit('updated')
  emit('close');
};

</script>

<template>
  <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-2xl font-bold mb-4">Edit Location</h2>
      <form @submit.prevent="updateLocation">
        <div class="mb-4">
          <label class="block text-gray-700">Country</label>
          <input
            v-model="location.country"
            type="text"
            class="w-full p-2 border border-gray-300 rounded mt-1" required/>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">City</label>
          <input
            v-model="location.city"
            type="text"
            class="w-full p-2 border border-gray-300 rounded mt-1" required/>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">State</label>
          <input
            v-model="location.state"
            type="text"
            class="w-full p-2 border border-gray-300 rounded mt-1" required/>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Zip Code</label>
          <input
            v-model="location.zip_code"
            type="text"
            class="w-full p-2 border border-gray-300 rounded mt-1" required/>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Street Adress</label>
          <textarea
            v-model="location.street_adress"
            class="w-full p-2 border border-gray-300 rounded mt-1"
            required
          ></textarea>
        </div>
        <div class="flex justify-end">
          <button
            type="button"
            @click="$emit('close')"
            class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel
          </button>
          <button
            type="submit"
            class="bg-green-500 text-white px-4 py-2 rounded">Edit
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
