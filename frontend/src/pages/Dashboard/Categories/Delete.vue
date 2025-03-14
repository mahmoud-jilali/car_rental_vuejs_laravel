<script setup>
import { ref } from 'vue';
import { useCategoriesStore } from '@/stores/categories';

const props = defineProps({
  show: Boolean,
  category: Object,
});
const emit = defineEmits(['close', 'deleted']);

const categoriesStore = useCategoriesStore();

const deleteCategory = async () => {
    if (props.category && props.category.id) {
        await categoriesStore.deleteCategory(props.category.id);
        emit('deleted');
        emit('close');
    }
};
</script>

<template>
  <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-2xl font-bold mb-4">Delete Category</h2>
      <p v-if="category">Are you sure you want to delete the category "{{ category.name }}"?</p>
      <div class="flex justify-end mt-4">
        <button type="button" @click="$emit('close')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
        <button type="button" @click="deleteCategory" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
      </div>
    </div>
  </div>
</template>