<script setup>
import {Head, useForm} from "@inertiajs/vue3";

const props = defineProps({
    user: Object
})

const form = useForm({
    name: props.user.name ??= '',
    email: props.user.email ??= '',
    password: '',
    password_confirmation: ''
})
</script>

<template>
    <Head title="Edit User"/>
    <form @submit.prevent="form.patch('/users/'+ user.id)"
          class="flex flex-col space-y-4">
        <div>
            <input v-model="form.name" type="text" placeholder="name"
                   class="rounded bg-gray-200"
            >
            <div class="text-sm text-red-600"
                 v-if="form.errors.name">{{ form.errors.name }}
            </div>
        </div>
        <div>
            <input v-model="form.email" type="email" placeholder="email"
                   class="rounded bg-gray-200">
            <div class="text-sm text-red-600"
                 v-if="form.errors.email">{{ form.errors.email }}
            </div>
        </div>
        <div>
            <input v-model="form.password" type="password" placeholder="password"
                   class="rounded bg-gray-200">
            <div class="text-sm text-red-600"
                 v-if="form.errors.password">{{ form.errors.password }}
            </div>
        </div>
        <div>
            <input v-model="form.password_confirmation" type="password" placeholder="confirm password"
                   class="rounded bg-gray-200">
            <div class="text-sm text-red-600"
                 v-if="form.errors.password">{{ form.errors.password_confirmation }}
            </div>
        </div>
        <div>
            <button type="submit"
                    :disabled="form.processing"
                    class="bg-blue-400 hover:bg-blue-700 dark:hover:text-white rounded px-4 py-2 border border-black"
            >Save
            </button>
        </div>
    </form>
</template>

<style scoped>

</style>
