<script setup>

import { ref } from 'vue'
import { useInsurancesStore } from '@/stores/insurances';

const props = defineProps({
  show: Boolean,
  insurance: Object,
});
const emit = defineEmits(['close', 'deleted']);

const insurancesStore = useInsurancesStore();

const deleteInsurance = async () => {
    if (props.insurance && props.insurance.id) {
        await insurancesStore.deleteInsurance(props.insurance.id);
        emit('deleted');
        emit('close');
    }
};
</script>

<template>
  <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-2xl font-bold mb-4">Delete Insurance</h2>
        <p v-if="insurance">Are you sure you want to delete <b>{{ insurance.name }}</b> insurance?</p>
      <div class="flex justify-end mt-4">
        <button type="button" @click="$emit('close')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">No</button>
        <button type="button" @click="deleteInsurance" class="bg-red-500 text-white px-4 py-2 rounded">Yes</button>
      </div>
    </div>
  </div>
</template>