import { defineStore } from "pinia";
import axios from "axios";

export const useRentalsStore = defineStore("rentals", {
    state: () => ({
        oldRentals: [],
        currentRentals: [],
        newRentals: [],
        rentalsErrors: [],
        isLoading: true,
    }),
    getters: {
        OldRentals: (state) => state.oldRentals,
        CurrentRentals: (state) => state.currentRentals,
        NewRentals: (state) => state.newRentals,
        errors: (state) => state.rentalsErrors,
        loading: (state) => state.isLoading,
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async getOldRentals() {
            this.rentalsErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                const res = await axios.get('/api/old_rentals')
                this.oldRentals = res.data.data
                this.isLoading = false
            } catch(error) {
                if(error.response.status === 401) {
                    this.router.push("/login")
                } 
                else if(error.response.status === 404) {
                    this.rentalsErrors = error.response.data.message
                    this.oldRentals = null
                    this.isLoading = false
                }
            }
        },
        async getCurrentRentals() {
            this.rentalsErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                const res = await axios.get('/api/current_rentals')
                this.currentRental = res.data.data
                this.isLoading = false
            } catch(error) {
                if(error.response.status === 401) {
                    this.router.push("/login")
                } 
                else if(error.response.status === 404) {
                    this.rentalsErrors = error.response.data.message
                    this.currentRentals = null
                    this.isLoading = false
                }
            }
        },
        async getNewRentals() {
            this.rentalsErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                const res = await axios.get('/api/new_rentals')
                this.newRentals = res.data.data
                this.isLoading = false
            } catch(error) {
                if(error.response.status === 401) {
                    this.router.push("/login")
                } 
                else if(error.response.status === 404) {
                    this.rentalsErrors = error.response.data.message
                    this.newRentals = null
                    this.isLoading = false
                }
            }
        },
    }
})