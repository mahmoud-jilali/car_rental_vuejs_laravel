import { defineStore } from "pinia";
import axios from "axios";

export const useCustomersStore = defineStore("customers", {
    state: () => ({
        customers: [],
        customerErrors: [],
        isLoading: true,
    }),
    getters: {
        customer: (state) => state.customers,
        errors: (state) => state.customerErrors,
        loading: (state) => state.isLoading,
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async getCustomers() {
            this.customerErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                const res = await axios.get('/api/customer')
                this.customers = res.data.customers
                this.isLoading = false
            } catch(error) { 
                if(error.response.status === 404) {
                    this.customerErrors = error.response.data.message
                    this.customers = null
                }
            } finally {
                this.isLoading = false
            }
        },
    }
})