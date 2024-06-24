<script setup>
import {Head, Link, router} from "@inertiajs/vue3";
import Pagination from "@/Pages/Pagination.vue";

import {ref, watch} from "vue";


const props = defineProps({
    users: Object,
    filters: String
})


const search = ref(props.filters?.search ?? '');
watch(search, value => {
    router.get('/users', {
        search: value
    }, {
        preserveState: true,
        replace: true
    })
});

</script>

<template>
    <Head title="Users"/>
    <div class="mt-4 mb-4">
        <span>
            <input v-model="search"
                   type="text" name="search" id="search" placeholder="search for"
                   class="rounded bg-gray-200">
        </span>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    User name
                </th>

                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users.data" :key="user.id"
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ user.name }}
                </th>

                <td class="px-6 py-4">
                    <Link v-if="user.can.edit_user"
                        :href="route('users.edit', {id: user.id})"
                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                </td>
            </tr>
            </tbody>
        </table>
    </div>


    <div class="mt-4">
        <Pagination :links="users.links"/>
    </div>
</template>

<style scoped>

</style>
