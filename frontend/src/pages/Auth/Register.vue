<script setup>
import { RouterLink, RouterView } from 'vue-router';
import Navbar from '@/components/Navbar/Navbar.vue'
import { ref } from 'vue';
import { useAuthStore } from '../../stores/auth'
import Footer from '@/components/Footer/Footer.vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faEye, faEyeSlash } from '@fortawesome/free-regular-svg-icons'


library.add(faEye, faEyeSlash)

const authStore = useAuthStore()

const form = ref({
    first_name: "",
    last_name: "",
    email: "",
    password: "",
    password_confirmation: "",
})

const showPassword = ref(false)
const showPasswordConfirmation = ref(false)

const showHidePassword = () => {
    showPassword.value = !showPassword.value
}

const showHidePasswordConfirmation = () => {
    showPasswordConfirmation.value = !showPasswordConfirmation.value
}

</script>

<template>
    <Navbar />

    <div
        class="flex min-h-full my-24 bg-blue-50 mx-auto w-2/3 flex-1 flex-col justify-center px-6 py-12 lg:px-8 rounded-lg">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <!-- <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" /> -->
            <h2 class="my-5 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create your account</h2>
        </div>
        <div class="my-5 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" @submit.prevent="authStore.register(form)">
                <div class="relative z-0 w-full my-2 group">
                    <input type="text" name="floating_first_name" id="floating_first_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-blue-500 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " v-model="form.first_name" />
                    <label for="floating_first_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-900 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-100 peer-focus:-translate-y-5">First
                        name</label>
                    <div v-if="authStore.errors.first_name">
                        <span class="text-red-500 text-sm mx-3 my-3">{{ authStore.errors.first_name[0] }}</span>
                    </div>
                </div>
                <div class="relative z-0 w-full my-2 group">
                    <input type="text" name="floating_last_name" id="floating_last_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-blue-500 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " v-model="form.last_name" />
                    <label for="floating_last_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-900 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-100 peer-focus:-translate-y-5">Last
                        name</label>
                    <div v-if="authStore.errors.last_name">
                        <span class="text-red-500 text-sm mx-3 my-3">{{ authStore.errors.last_name[0] }}</span>
                    </div>
                </div>
                <div class="relative z-0 w-full my-2 group">
                    <input type="email" name="floating_email" id="floating_email"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-blue-500 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " v-model="form.email" />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-sm text-gray-900 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-100 peer-focus:-translate-y-5">Email
                        address</label>
                    <div v-if="authStore.errors.email">
                        <span class="text-red-500 text-sm mx-3 my-3">{{ authStore.errors.email[0] }}</span>
                    </div>
                </div>
                <div class="relative z-0 w-full my-2 group">
                    <div class="flex">
                        <input name="password" id="password" :type="showPassword ? 'text' : 'password'"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-blue-500 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " v-model="form.password" />
                            <FontAwesomeIcon :icon="showPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye'" @click="showHidePassword()"
                            class="py-3 border-0 w-auto border-b-2 border-blue-500 cursor-pointer" />
                        <label for="password"
                            class="peer-focus:font-medium absolute text-sm text-gray-900 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-100 peer-focus:-translate-y-5">Password</label>
                    </div>
                    <div v-if="authStore.errors.password">
                        <span class="text-red-500 text-sm mx-3 my-3">{{ authStore.errors.password[0] }}</span>
                    </div>
                </div>
                <div class="relative z-0 w-full my-2 group">
                    <div class="flex">
                        <input name="floating_c_password" id="floating_c_password" :type="showPasswordConfirmation ? 'text' : 'password'"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-blue-500 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " v-model="form.password_confirmation" />
                            <FontAwesomeIcon :icon="showPasswordConfirmation ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye'" @click="showHidePasswordConfirmation()"
                            class="py-3 border-0 w-auto border-b-2 border-blue-500 cursor-pointer" />
                        <label for="floating_c_password"
                            class="peer-focus:font-medium absolute text-sm text-gray-900 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-100 peer-focus:-translate-y-5">Confirm your password</label>
                    </div>
                    <div v-if="authStore.errors.password_confirmation">
                        <span class="text-red-500 text-sm mx-3 my-3">{{ authStore.errors.password_confirmation[0] }}</span>
                    </div>
                </div>
                <div class="flex items-center mx-2">
                    <button type="submit" class="text-white bg-blue-500 hover:bg-white hover:text-blue-500 hover:border border-blue-500 font-medium rounded-lg text-sm mx-4 px-4 py-2 text-center">
                        <template v-if="!authStore.isLoading">Register</template>
                        <template v-else>
                            <div role="status">
                                <svg class="w-5 h-5 mx-auto text-white animate-spin fill-blue-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </template>
                    </button>
                    <p class="my-3 text-center text-sm text-gray-500">Already have an account?
                        <RouterLink to="/login" class="font-semibold leading-6 text-blue-700 hover:text-blue-800">Log in</RouterLink>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <Footer />

<RouterView />
</template>