import { defineStore } from "pinia";
import axios from "axios";

export const useInsurancesStore = defineStore("insurances", {
    state: () => ({
        insurances: [],
        insuranceErrors: [],
        isLoading: true,
    }),
    getters: {
        insurance: (state) => state.insurances,
        errors: (state) => state.insuranceErrors,
        loading: (state) => state.isLoading,
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async getInsurances() {
            this.insuranceErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                const res = await axios.get('/api/insurance')
                this.insurances = res.data.insurances
                this.isLoading = false
            } catch(error) { 
                if(error.response.status === 404) {
                    this.insuranceErrors = error.response.data.message
                    this.insurances = null
                }
            } finally {
                this.isLoading = false
            }
        },
    }
})