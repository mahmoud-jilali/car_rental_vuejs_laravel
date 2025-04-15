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
        async getCar(id) {
            this.carErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                const res = await axios.get(`/api/car/${id}`)
                this.cars = res.data.car
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
        async addCar(car) {
            this.carErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                await axios.post('/api/car', car)
                await this.getCars()
            } catch(error) {
                this.carErrors = error.response.data.errors
            } finally {
                this.isLoading = false
            }
        },
        async updateCar(id, data) {
            this.carErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                await axios.post(`/api/car/${id}`, data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                await this.getCars()
            } catch(error) {
                this.carErrors = error.response.data.errors
            } finally {
                this.isLoading = false
            }
        },
        async deleteCar(id) {
            this.carErrors = []
            this.isLoading = true
            await this.getToken()
            try {
                await axios.delete(`/api/car/${id}`)
                await this.getCars()
            } catch(error) {
                this.carErrors = error.response.data.errors
            } finally {
                this.isLoading = false
            }
        }
    }
})