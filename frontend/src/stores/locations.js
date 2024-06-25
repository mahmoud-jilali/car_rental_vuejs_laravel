import { defineStore } from "pinia";
import axios from "axios";

export const useLocationsStore = defineStore("locations", {
    state: () => ({
        locations: [],
        locationErrors: [],
        isLoading: true,
    }),
    getters: {
        location: (state) => state.locations,
        errors: (state) => state.locationErrors,
        loading: (state) => state.isLoading,
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async getLocations() {
            this.locationErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                const res = await axios.get('/api/location')
                this.locations = res.data.locations
                this.isLoading = false
            } catch(error) {
                if(error.response.status === 401) {
                    this.router.push("/login")
                } 
                else if(error.response.status === 404) {
                    this.locationErrors = error.response.data.message
                    this.locations = null
                }
            } finally {
                this.isLoading = false
            }
        },
        async getSearchLocation() {
            this.locationErrors = []
            this.isLoading = true
            try {
                const res = await axios.get('/api/search_location')
                this.locations = res.data.locations
                this.isLoading = false
            } catch(error) {
                if(error.response.status === 404) {
                    this.locationErrors = error.response.data.message
                    this.locations = null
                }
            } finally {
                this.isLoading = false
            }
        },
    }
})