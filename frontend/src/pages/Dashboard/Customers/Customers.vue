<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { ref, onMounted } from 'vue'
import { useCustomersStore } from '@/stores/customers'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faEllipsisVertical, faTrashCan } from '@fortawesome/free-solid-svg-icons'
import SidebarNav from '@/components/SidebarNav/SidebarNav.vue'

library.add(faEllipsisVertical, faTrashCan)
const customersStore = useCustomersStore()

onMounted(async() => {
    await customersStore.getCustomers()
})

const actions = ref(false)

const showActions = (row) => {
    actions.value = (actions.value === row) ? false : row;
}

</script>

<template>
    
    <SidebarNav />
    <div class="flex mx-auto justify-between my-14 w-11/12">
        <h3 class="uppercase text-4xl font-bold text-blue-500 md:text-4xl ml-60">Customers</h3>
    </div>
    <template v-if="customersStore.loading">
        <div role="status">
            <svg class="w-10 h-10 mx-auto mt-48 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </template>
    <template v-else-if="customersStore.customer.length === 0">
        <div class="bg-blue-100 text-md font-semibold w-1/2 p-7 my-10 mx-auto rounded-md">
            <p>No Data Available</p>
        </div>
    </template>
    <template v-else="customersStore.customer">
        <table class="w-3/4 ml-72 text-sm text-left rtl:text-right text-gray-900 cursor-pointer">
            <thead class="text-xs text-gray-900 border-x uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        E-mail
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Birth date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Driving license number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Driving license date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(customer, row) in customersStore.customer" class="bg-white border-b border-x">
                    <td class="px-6 py-4">
                        {{ customer.full_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ customer.user.email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ customer.birth_date }}
                    </td>
                    <td class="px-6 py-4">
                        {{ customer.driving_license_number }}
                    </td>
                    <td class="px-6 py-4">
                        {{ customer.driving_license_date }}
                    </td>
                    <td class="px-6 py-4 flex">
                        <FontAwesomeIcon icon="ellipsis-vertical"
                            class="mr-auto py-4 cursor-pointer hover:text-blue-500" @click="showActions(row)" />
                        <div v-if="actions === row" class="absolute rigth-auto border rounded-lg w-auto mt-8 bg-gray-50">
                            <p class="p-2 flex hover:bg-gray-200 cursor-pointer">
                                <FontAwesomeIcon icon="trash-can" class="mr-1 py-1 cursor-pointer text-red-600" />Delete
                            </p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </template>

    <RouterView />
</template>