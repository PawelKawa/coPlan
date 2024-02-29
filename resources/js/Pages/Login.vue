<template>
    <!-- form.post is inertia helper, route('login') is ziggy package, allows to use names from web.php -->
    <form @submit.prevent="form.post(route('login'))" class="flex justify-center">
        <div class="w-full max-w-md p-6 bg-white rounded-md shadow-md">
            <h1 class="text-2xl font-bold mb-6">Login</h1>
            <div>
                <label for="email" class="block mb-2 text-sm font-bold text-gray-700">E-mail (username)</label>
                <input id="email" v-model="form.email" type="text" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" autocomplete="on"/>
            </div>
            <div v-if="form.errors.email" class="mt-2 text-sm text-red-500">{{ form.errors.email }}</div>
            <div class="mt-4">
                <label for="password" class="block mb-2 text-sm font-bold text-gray-700">Password</label>
                <input id="password" v-model="form.password" type="password" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" />
            </div>
            <div v-if="form.errors.password" class="mt-2 text-sm text-red-500">{{ form.errors.password }}</div>
            <div class="mt-6">
                <button class="w-full p-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600" type="submit">Login</button>
            </div>
        </div>
    </form>
    <div class="mt-8 text-center">
        <Link :href="route('register.form')" class="text-sm py-1 px-4 bg-white rounded">Need to register? Click here!</Link>
    </div>
</template>

<script>
import { useForm, Link } from '@inertiajs/vue3'
export default {
    name: 'login',
    components: {
        Link
    },
    data() {
        return {
            form: useForm({
                email: null,
                password: null,
            })
        }
    }
}
</script>