<script setup>

</script>

<template>
    <main class="w-[968px] m-auto bg-gray-300 min-h-screen p-4">
        <header class="flex justify-between">
            <div class="space-x-2">
                <Link href="/"
                      :class="{'font-bold underline': $page.component === 'Home' }">Home
                </Link>
                <Link href="/about" :class="{'font-bold underline': $page.component === 'About' }">About</Link>
                <Link href="/contact" :class="{'font-bold underline': $page.component === 'Contact' }">Contact</Link>
                <Link href="/users" :class="{'font-bold underline': $page.component === 'Users' }">Users</Link>
                <Link href="/users/create" :class="{'font-bold underline': $page.component === 'Users/Create' }">Create User</Link>

            </div>
            <div class="space-x-2">

                <Link href="/login" v-if="!$page.props.auth.user">Login</Link>

                <Link href="/logout"
                      v-else method="post" as="button" type="button"
                      class="text-blue-600 font-semibold"
                >Logout
                </Link>
            </div>
        </header>
        <article>
            <slot/>
        </article>
    </main>
</template>

<style scoped>

</style>
