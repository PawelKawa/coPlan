
<template>
    <div class="flex justify-center gap-10 bg-black text-white py-4 text-2xl">
        <Link href="/">Home</Link>
        <Link href="/calendar">Calendar</Link>
        <Link href="/shopping">Shopping</Link>
        <Link href="/work">Work</Link>
    </div>

    <main class="bg-gray-600">
        <div class="max-w-screen-lg mx-auto h-screen">
            <slot />
        </div>
    </main>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

</script>