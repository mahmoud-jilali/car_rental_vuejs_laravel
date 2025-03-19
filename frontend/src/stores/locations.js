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
                if(error.response.status === 404) {
                    this.locationErrors = error.response.data.message
                    this.locations = null
                }
            } finally {
                this.isLoading = false
            }
        },
        async addLocation(data) {
            this.locationErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.post('/api/location', {
                    country: data.country,
                    state: data.state,
                    city: data.city,
                    zip_code: data.zip_code,
                    street_adress: data.street_adress,
                });
                this.isLoading = false;
                await this.getLocations()
            } catch(error) {
                this.isLoading = false;
                if(error.response.status === 422){
                    this.locationErrors = error.response.data.errors
                }
            }
        },
        async updateLocation(data) {
            this.locationErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.put(`/api/location/${data.id}`, {
                    country: data.country,
                    state: data.state,
                    city: data.city,
                    zip_code: data.zip_code,
                    street_adress: data.street_adress,
                });
                this.isLoading = false;
                await this.getLocations()
            } catch(error) {
                this.isLoading = false;
                if(error.response.status === 422){
                    this.locationErrors = error.response.data.errors
                }
            }
        },
        async deleteLocation(id) {
            this.locationErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.delete(`/api/location/${id}`);
                this.isLoading = false;
            } catch(error) {
                this.isLoading = false;
                if(error.response.status === 422){
                    this.locationErrors = error.response.data.errors
                }
            } finally{
                await this.getLocations()
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