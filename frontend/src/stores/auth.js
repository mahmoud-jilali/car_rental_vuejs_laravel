import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        authUser: null,
        authErrors: [],
        authStatus: null,
        isLoading: false,
    }),
    getters: {
        user: (state) => state.authUser,
        errors: (state) => state.authErrors,
        status: (state) => state.authStatus,
        loading: (state) => state.isLoading,
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async getUser() {
            await this.getToken()
            try {
                const res = await axios.get('/api/user')
                this.authUser = res.data
            } catch(error) {
                if(error.res && error.res.status === 401){
                    this.authUser = null
                }
            }
        },
        async login(data) {
            this.authErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.post("/login", {
                    email: data.email,
                    password: data.password
                });
                this.router.push("/")
            } catch(error){
                this.isLoading = false;
                if(error.response.status === 422){
                    this.authErrors = error.response.data.errors
                }
            } finally {
                this.isLoading = false;
            }
        },
        async register(data) {
            this.authErrors = [];
            this.isLoading = true;
            await this.getToken()
            try {
                await axios.post('/register', {
                    first_name: data.first_name,
                    last_name: data.last_name,
                    email: data.email,
                    password: data.password,
                    password_confirmation: data.password_confirmation
                });
                this.router.push("/");
            } catch(error){
                this.isLoading = false;
                if(error.response.status === 422){
                    this.authErrors = error.response.data.errors
                }
            } finally {
                this.isLoading = false;
            }
        },
        async forgotPassword(email) {
            this.authErrors = [];
            this.isLoading = true;
            this.getToken();
            try {
                const res = await axios.post("/forgot-password", {
                    email: email,
                });
                this.authStatus = res.data.status;
            } catch(error){
                this.isLoading = false;
                if(error.response.status === 422){
                    this.authErrors = error.response.data.errors
                }
            } finally {
                this.isLoading = false;
            }
        },
        async resetPassword(data) {
            this.authErrors = [];
            try {
                await axios.post('/reset-password', data);
                this.router.push('/login')
            } catch(error) {
                if(error.response.status === 422){
                    this.authErrors = error.response.data.errors
                }
            }
        },
        async logout() {
            await axios.post('/logout');
            this.authUser = null;
        },
        async editName(data) {
            this.authErrors = [];
            this.isLoading = true;
            await this.getToken();
            try {
                const res = await axios.put('/edit_name', {
                    first_name: data.first_name,
                    last_name: data.last_name
                });
                data.message = res.data.message
                this.isLoading = false;
            } catch(error) {
                if(error.response.status === 422){
                    this.authErrors = error.response.data.errors
                }
            } finally {
                await this.getUser();
                this.isLoading = false;
            }
        }
    }
})