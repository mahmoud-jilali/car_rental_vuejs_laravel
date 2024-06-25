import { defineStore } from "pinia";
import axios from "axios";

export const useCarsStore = defineStore("cars", {
    state: () => ({
        cars: [],
        carErrors: [],
        isLoading: true,
    }),
    getters: {
        car: (state) => state.cars,
        errors: (state) => state.carErrors,
        loading: (state) => state.isLoading,
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async getCars() {
            this.carErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                const res = await axios.get('/api/car')
                this.cars = res.data.cars
                this.isLoading = false
            } catch(error) { 
                if(error.response.status === 404) {
                    this.locationErrors = error.response.data.message
                    this.cars = null
                }
            } finally {
                this.isLoading = false
            }
        },
    }
})