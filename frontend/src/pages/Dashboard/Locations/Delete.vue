<script setup>
import { ref } from 'vue';
import { useLocationsStore } from '@/stores/locations';

const props = defineProps({
  show: Boolean,
  location: Object,
});
const emit = defineEmits(['close', 'deleted']);

const locationsStore = useLocationsStore();

const deleteLocation = async () => {
    if (props.location && props.location.id) {
        await locationsStore.deleteLocation(props.location.id);
        emit('deleted');
        emit('close');
    }
};
</script>

<template>
  <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-2xl font-bold mb-4">Delete Location</h2>
        <p v-if="location">Are you sure you want to delete
            <b>{{ location.street_adress }}, {{ location.city }}, {{ location.country }}</b> location?
        </p>
      <div class="flex justify-end mt-4">
        <button type="button" @click="$emit('close')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">No</button>
        <button type="button" @click="deleteLocation" class="bg-red-500 text-white px-4 py-2 rounded">Yes</button>
      </div>
    </div>
  </div>
</template>