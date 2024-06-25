import { defineStore } from "pinia";
import axios from "axios";

export const useFuelOptionsStore = defineStore("fuelOptions", {
    state: () => ({
        fuelOptions: [],
        fuelOptionErrors: [],
        isLoading: true,
    }),
    getters: {
        fuelOption: (state) => state.fuelOptions,
        errors: (state) => state.fuelOptionErrors,
        loading: (state) => state.isLoading,
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async getFuelOptions() {
            this.fuelOptionErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                const res = await axios.get('/api/fuel_option')
                this.fuelOptions = res.data.fuel_options
                this.isLoading = false
            } catch(error) { 
                if(error.response.status === 404) {
                    this.fuelOptionErrors = error.response.data.message
                    this.fuelOptions = null
                }
            } finally {
                this.isLoading = false
            }
        },
    }
})