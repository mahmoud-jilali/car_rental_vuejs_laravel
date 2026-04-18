import { defineStore } from "pinia";
import axios from "axios";

export const useBrandsStore = defineStore("brands", {
    state: () => ({
        brands: [],
        brandErrors: [],
        isLoading: true,
    }),
    getters: {
        brand: (state) => state.brands,
        errors: (state) => state.brandErrors,
        loading: (state) => state.isLoading,
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async getBrands() {
            this.brandErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                const res = await axios.get('/api/brand')
                this.brands = res.data.brands
                this.isLoading = false
            } catch(error) { 
                if(error.response.status === 404) {
                    this.brandErrors = error.response.data.message
                    this.brands = null
                }
            } finally {
                this.isLoading = false
            }
        },
        async addBrand(data) {
            this.brandErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.post('/api/brand', {
                    name: data.name,
                    description: data.description
                });
                this.isLoading = false;
                await this.getBrands()
            } catch(error) {
                this.isLoading = false;
                if(error.response.status === 422){
                    this.brandErrors = error.response.data.errors
                }
            }
        },
        async updateBrand(data) {
            this.brandErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.put(`/api/brand/${data.id}`, {
                    name: data.name,
                    description: data.description
                });
                this.isLoading = false;
                await this.getBrands()
            } catch(error) {
                this.isLoading = false;
                if(error.response.status === 422){
                    this.brandErrors = error.response.data.errors
                }
            }
        },
        async deleteBrand(id) {
            this.brandErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.delete(`/api/brand/${id}`);
                this.isLoading = false;
            } catch(error) {
                this.isLoading = false;
                if(error.response.status === 422){
                    this.brandErrors = error.response.data.errors
                }
            } finally{
                await this.getBrand()
            }
        }
    }
})