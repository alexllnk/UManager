<script setup>
import Layout from "@/Pages/Layout.vue";
import {Head, usePage} from "@inertiajs/vue3";
import {computed, reactive} from "vue";

defineProps({
    frameworks: Array,
    time: String
})


const author = reactive({
    name: 'bob',
    books: [
        'b1 - b',
        'b2 - bb'
    ]
})

const publishedBooksMessage = computed(() => {
    return author.books.length > 0 ? 'Yes' : 'No'
})
const page = usePage()
</script>

<template>
    <Head title="Welcome"/>
    <h1>Home</h1>
</template>

<style scoped>

</style>
