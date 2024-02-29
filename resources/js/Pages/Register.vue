<template>
    <form @submit.prevent="form.post(route('register'))" class="flex justify-center">
        <div class="w-full max-w-md p-6 bg-white rounded-md shadow-md">
            <h1 class="text-2xl font-bold mb-6">Register</h1>
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-bold text-gray-700">Your Name</label>
                <input id="name" v-model="form.name" type="text" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" autocomplete="given-name"/>
                <div v-if="form.errors.name" class="mt-2 text-sm text-red-500">{{ form.errors.name }}</div>
            </div>
            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-bold text-gray-700">E-mail</label>
                <input id="email" v-model="form.email" type="text" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" autocomplete="email"/>
                <div v-if="form.errors.email" class="mt-2 text-sm text-red-500">{{ form.errors.email }}</div>
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-2 text-sm font-bold text-gray-700">Password</label>
                <input id="password" v-model="form.password" type="password" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" />
                <div v-if="form.errors.password" class="mt-2 text-sm text-red-500">{{ form.errors.password }}</div>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block mb-2 text-sm font-bold text-gray-700">Confirm Password</label>
                <input id="password_confirmation" v-model="form.password_confirmation" type="password" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" />
            </div>
            <div>
                <button class="w-full p-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600" type="submit">Create Account</button>
            </div>
        </div>
    </form>
    <div class="mt-8 text-center">
        <Link :href="route('login.form')" class="text-sm py-1 px-4 bg-white rounded">Already register? Click here!</Link>
    </div>
    <div v-if="$page.props.user">{{ $page.props.user }}</div>
</template>

<script>
import { useForm, Link } from '@inertiajs/vue3'
export default {
    name: 'register',
    components: {
        Link
    },
    data() {
        return {
            form: useForm({
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            })
        }
    },
}
</script>