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
        async addInsurance(data) {
            this.insuranceErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.post('/api/insurance', {
                    name: data.name,
                    cost: data.cost,
                    description: data.description,
                });
                this.isLoading = false;
                await this.getInsurances()
            } catch(error) {
                this.isLoading = false;
                if(error.response.status === 422){
                    this.insuranceErrors = error.response.data.errors
                }
            }
        },
        async updateInsurance(data) {
            this.insuranceErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.put(`/api/insurance/${data.id}`, {
                    name: data.name,
                    cost: data.cost,
                    description: data.description,
                });
                this.isLoading = false;
                await this.getInsurances()
            } catch(error) {
                this.isLoading = false;
                if(error.response.status === 422){
                    this.insuranceErrors = error.response.data.errors
                }
            }
        },
        async deleteInsurance(id) {
            this.insuranceErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.delete(`/api/insurance/${id}`);
                this.isLoading = false;
            } catch(error) {
                this.isLoading = false;
                if(error.response.status === 422){
                    this.insuranceErrors = error.response.data.errors
                }
            } finally{
                await this.getInsurances()
            }
        },
    }
})