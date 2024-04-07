<template>
    <div class="flex justify-center gap-10 bg-black text-white py-4 text-2xl">
        <Link :href="route('homepage')">Home</Link>
        <div v-if="user" class="flex gap-10">
            <!-- <Link :href="route('calendar')">Calendar</Link> -->
            <Link :href="route('shopping')">Shopping</Link>
            <!-- <Link :href="route('work')">Work</Link> -->
            <Link :href="route('finder')">Finder</Link>
            <div class="text-xs">Hello {{ user }}</div>
            <Link :href="route('logout')" method="delete" as="button">Logout</Link>
        </div>
        <div v-else class="flex gap-10">
            <Link :href="route('register.form')">Register</Link>
            <Link :href="route('login.form')">Login</Link>
        </div>
    </div>

    <main class="bg-gray-600">
        <div>
            <div class="relative" v-if="flashSucces">
                <div class="bg-green-200 text-center absolute w-full">{{ flashSucces }}</div>
            </div>
            <div class="relative" v-if="flashInfo">
                <div class="bg-blue-200 text-center absolute w-full">{{ flashInfo }}</div>
            </div>
            <div class="relative" v-if="flashError">
                <div class="bg-red-200 text-center absolute w-full">{{ flashError }}</div>
            </div>
            <div class="relative" v-if="Object.keys(errors).length > 0">
                <div class="bg-red-200 text-center absolute w-full">
                    {{ errors[Object.keys(errors)[0]] }}
                </div>
            </div>

        </div>
        <div class="max-w-screen-lg mx-auto min-h-screen py-8">
            <slot />
        </div>
    </main>
</template>

<script>
import { Link } from '@inertiajs/vue3'
export default {
    components: {
        Link
    },
    computed: {
        flashSucces() {
            return this.$page.props.flash.success
        },
        flashInfo() {
            return this.$page.props.flash.info
        },
        flashError() {
            return this.$page.props.flash.error
        },
        //this error is for validation, i guess
        errors() {
            return this.$page.props.errors
        },
        user() {
            return this.$page.props.user
        }
    }
}

</script>