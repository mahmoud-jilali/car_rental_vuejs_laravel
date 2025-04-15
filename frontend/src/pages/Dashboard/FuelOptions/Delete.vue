<script setup>
import { ref } from 'vue';
import { useFuelOptionsStore } from '@/stores/fuelOptions';

const props = defineProps({
  show: Boolean,
  fuelOption: Object,
});
const emit = defineEmits(['close', 'deleted']);

const fuelOptionsStore = useFuelOptionsStore();

const deleteFuelOptions = async () => {
    if (props.fuelOption && props.fuelOption.id) {
        await fuelOptionsStore.deleteFuelOption(props.fuelOption.id);
        emit('deleted');
        emit('close');
    }
};
</script>

<template>
  <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-2xl font-bold mb-4">Delete fuel option</h2>
      <p v-if="fuelOption">Are you sure you want to delete <b>{{ fuelOption.name }}</b> fuel option?</p>
      <div class="flex justify-end mt-4">
        <button type="button" @click="$emit('close')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">No</button>
        <button type="button" @click="deleteFuelOptions" class="bg-red-500 text-white px-4 py-2 rounded">Yes</button>
      </div>
    </div>
  </div>
</template>