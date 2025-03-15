<script setup>

import { ref, watch } from 'vue';
import { useFuelOptionsStore } from '@/stores/fuelOptions';

const props = defineProps({
  show: Boolean,
  fuelOption: Object
});
const emit = defineEmits(['close', 'updated'])

const fuelOptionsStore = useFuelOptionsStore()
const fuelOption = ref({ ...props.fuelOption })

watch(() => props.fuelOption, (newFuelOption) => {
  fuelOption.value = { ...newFuelOption };
});

const updateFuelOption = async () => {
  await fuelOptionsStore.updateFuelOption(fuelOption.value);
  emit('updated')
  emit('close');
};

</script>

<template>
  <div
    v-if="show"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
  >
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-2xl font-bold mb-4">Update fuel option</h2>
      <form @submit.prevent="updateFuelOption">
        <div class="mb-4">
          <label class="block text-gray-700">Name</label>
          <input
            v-model="fuelOption.name"
            type="text"
            class="w-full p-2 border border-gray-300 rounded mt-1"
            required
          />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Description</label>
          <textarea
            v-model="fuelOption.description"
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