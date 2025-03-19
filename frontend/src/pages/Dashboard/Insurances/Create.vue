<script setup>

import { ref } from 'vue';
import { useInsurancesStore } from '@/stores/insurances';

const props = defineProps({
  show: Boolean
});
const emit = defineEmits(['close', 'saved']);

const name = ref('');
const cost = ref('');
const description = ref('');
const insurancesStore = useInsurancesStore();

const closeModal = () => {
  emit('close');
};

const addInsurance = async () => {
  await insurancesStore.addInsurance({ name: name.value, cost: cost.value, description: description.value });
    name.value = '';
    cost.value = '';
    description.value = '';
  emit('saved');
  emit('close');
};

</script>

<template>
  <div
    v-if="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-2xl font-bold mb-4">Add New Insurance</h2>
      <form @submit.prevent="addInsurance">
        <div class="mb-4">
          <label class="block text-gray-700">Name</label>
          <input
            v-model="name"
            type="text"
            class="w-full p-2 border border-gray-300 rounded mt-1" required/>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Cost</label>
          <input
            v-model="cost"
            type="text"
            class="w-full p-2 border border-gray-300 rounded mt-1" required/>
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
          <button @click="closeModal" type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">
            Cancel
          </button>
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" >
            Add
          </button>
        </div>
      </form>
    </div>
  </div>
</template>