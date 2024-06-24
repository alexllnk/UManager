<script setup>
import {Link} from "@inertiajs/vue3";


defineProps({
    links: Array
})
</script>

<template>
    <Component v-for="link in links"
               :is="link.url ? Link : 'span'"
               :href="link.url"
               v-html="link.label"
               class="px-3 py-1 bg-gray-100 rounded m-1 hover:bg-blue-300"
               :class="{
                   'text-gray-100/50 bg-gray-600 hover:bg-gray-600':!link.url,
               '!bg-blue-400':link.active
               }

"

    />
</template>

<style scoped>

</style>
