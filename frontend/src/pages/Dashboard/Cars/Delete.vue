<script setup>
import { ref } from 'vue';
import { useCarsStore } from '@/stores/cars';

const props = defineProps({
  show: Boolean,
  car: Object,
});
const emit = defineEmits(['close', 'deleted']);

const carsStore = useCarsStore();

const deleteCar = async () => {
    if (props.car && props.car.id) {
        await carsStore.deleteCar(props.car.id);
        emit('deleted');
        emit('close');
    }
};
</script>

<template>
  <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-2xl font-bold mb-4">Delete Car</h2>
      <p v-if="car">Are you sure you want to delete <b>{{ car.brand }} {{ car.model }}</b> car?</p>
      <div class="flex justify-end mt-4">
        <button type="button" @click="$emit('close')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">No</button>
        <button type="button" @click="deleteCar" class="bg-red-500 text-white px-4 py-2 rounded">Yes</button>
      </div>
    </div>
  </div>
</template>