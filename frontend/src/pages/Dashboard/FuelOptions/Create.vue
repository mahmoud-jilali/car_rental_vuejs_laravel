<script setup>

import { ref } from 'vue';
import { useFuelOptionsStore } from '@/stores/fuelOptions';

const props = defineProps({
  show: Boolean
});
const emit = defineEmits(['close', 'saved']);

const name = ref('');
const description = ref('');
const fuelOptionsStore = useFuelOptionsStore();

const closeModal = () => {
  emit('close');
};

const addFuelOption = async () => {
  await fuelOptionsStore.addFuelOption({ name: name.value, description: description.value });
  name.value = '';
  description.value = '';
  emit('saved');
  emit('close');
};

</script>

<template>
  <div
    v-if="show"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
  >
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-2xl font-bold mb-4">Add New Fuel Option</h2>
      <form @submit.prevent="addFuelOption">
        <div class="mb-4">
          <label class="block text-gray-700">Name</label>
          <input
            v-model="name"
            type="text"
            class="w-full p-2 border border-gray-300 rounded mt-1"
            required
          />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Description</label>
          <textarea
            v-model="description"
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