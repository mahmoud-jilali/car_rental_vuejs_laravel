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
        async addCategory(data) {
            this.categoryErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.post('/api/car_category', {
                    name: data.name,
                    description: data.description
                });
                this.isLoading = false;
                await this.getCategories()
            } catch(error) {
                this.isLoading = false;
                if(error.response.status === 422){
                    this.categoryErrors = error.response.data.errors
                }
            }
        },
        async updateCategory(data) {
            this.categoryErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.put(`/api/car_category/${data.id}`, {
                    name: data.name,
                    description: data.description
                });
                this.isLoading = false;
                await this.getCategories()
            } catch(error) {
                this.isLoading = false;
                if(error.response.status === 422){
                    this.categoryErrors = error.response.data.errors
                }
            }
        },
        async deleteCategory(id) {
            this.categoryErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.delete(`/api/car_category/${id}`);
                this.isLoading = false;
            } catch(error) {
                this.isLoading = false;
                if(error.response.status === 422){
                    this.categoryErrors = error.response.data.errors
                }
            } finally{
                await this.getCategories()
            }
        }
    }
})