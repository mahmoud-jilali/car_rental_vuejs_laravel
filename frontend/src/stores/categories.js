import { defineStore } from "pinia";
import axios from "axios";

export const useCategoriesStore = defineStore("categories", {
    state: () => ({
        categories: [],
        categoryErrors: [],
        isLoading: true,
    }),
    getters: {
        category: (state) => state.categories,
        errors: (state) => state.categoryErrors,
        loading: (state) => state.isLoading,
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async getCategories() {
            this.categoryErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                const res = await axios.get('/api/car_category')
                this.categories = res.data.categories
                this.isLoading = false
            } catch(error) { 
                if(error.response.status === 404) {
                    this.categoryErrors = error.response.data.message
                    this.categories = null
                }
            } finally {
                this.isLoading = false
            }
        },
    }
})