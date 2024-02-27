
<template>
    <div class="flex justify-center gap-10 bg-black text-white py-4 text-2xl">
        <Link href="/">Home</Link>
        <Link href="/calendar">Calendar</Link>
        <Link href="/shopping">Shopping</Link>
        <Link href="/work">Work</Link>
    </div>
    
    <main class="bg-gray-600">
        <div class="py-2">
            <div class="relative">
                <div v-if="flashSucces" class="bg-green-200 p-1 text-center absolute w-full">{{ flashSucces }}</div>
            </div>
            <div class="relative">
                <div v-if="flashInfo" class="bg-blue-200 p-1 text-center absolute w-full">{{ flashInfo }}</div>
            </div>
            <div class="relative">
                <div v-if="flashError" class="bg-red-200 p-1 text-center absolute w-full">{{ flashError }}</div>
            </div>
        </div>
        <div class="max-w-screen-lg mx-auto h-screen py-8">
            <slot />
        </div>
    </main>
</template>

<script>
import { Link } from '@inertiajs/vue3'
export default{
    components: {
        Link
    },
    computed:{
        flashSucces() {
            return this.$page.props.flash.success
        },
        flashInfo() {
            return this.$page.props.flash.info
        },
        flashError() {
            return this.$page.props.flash.error
        },
    }
}

</script>