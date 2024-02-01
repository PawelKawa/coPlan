
<template>
    <div class="flex justify-center gap-10 bg-black text-white py-4 text-2xl">
        <Link href="/" class="">
        Home
        </Link>
        <Link href="/login">
        Login
        </Link>
    </div>

    <main class="bg-gray-600">
        <slot />
    </main>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

</script>