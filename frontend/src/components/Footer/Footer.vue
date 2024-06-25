<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faFacebook, faInstagram, faTwitter, faLinkedin } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faFacebook, faInstagram, faTwitter, faLinkedin)

</script>

<template>

    <footer class="bg-blue-50 mt-10">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="https://flowbite.com/" class="flex items-center">
                        <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" /> -->
                        <span class="text-blue-600 self-center text-2xl font-semibold whitespace-nowrap">Car Rental</span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-20 sm:gap-20 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-3 text-sm font-semibold text-gray-900 uppercase">Services</h2>
                        <ul class="text-blue-500 font-medium">
                            <li class="my-2">
                                <a href="#" class="hover:underline">Insurance</a>
                            </li>
                            <li class="my-2">
                                <a href="#" class="hover:underline">How it works</a>
                            </li>
                            <li class="my-2">
                                <a href="#" class="hover:underline">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-3 text-sm font-semibold text-gray-900 uppercase">Account</h2>
                        <ul class="text-blue-500 font-medium">
                            <li class="my-2">
                                <RouterLink to="/register" class="hover:underline">Sign Up</RouterLink>
                            </li>
                            <li class="my-2">
                                <RouterLink to="/login" class="hover:underline">Log In</RouterLink>
                            </li>
                            <li class="my-2">
                                <RouterLink to="/forgot_password" class="hover:underline">Forgot Password</RouterLink>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-3 text-sm font-semibold text-gray-900 uppercase">Follow us</h2>
                        <ul class="text-blue-500 font-medium">
                            <li class="my-2">
                                <a href="#" class="hover:underline ">Facebook</a>
                            </li>
                            <li class="my-2">
                                <a href="#" class="hover:underline">Instagram</a>
                            </li>
                            <li class="my-2">
                                <a href="#" class="hover:underline">Twitter</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-blue-600 sm:mx-auto lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-600 sm:text-center">© 2024 <a href="#"
                        class="hover:underline">JILOX DEV™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center sm:mt-0">
                    <a href="#" class="text-blue-500 hover:text-blue-600">
                        <FontAwesomeIcon icon="fa-brands fa-facebook" />
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-blue-500 hover:text-blue-600 ms-5">
                        <FontAwesomeIcon icon="fa-brands fa-instagram" />
                        <span class="sr-only">Instagram page</span>
                    </a>
                    <a href="#" class="text-blue-500 hover:text-blue-600 ms-5">
                        <FontAwesomeIcon icon="fa-brands fa-twitter" />
                        <span class="sr-only">Twitter page</span>
                    </a>
                    <a href="#" class="text-blue-500 hover:text-blue-600 ms-5">
                        <FontAwesomeIcon icon="fa-brands fa-linkedin" />
                        <span class="sr-only">LinkedIn page</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

<RouterView />

</template>