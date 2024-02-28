<template>
    <form @submit.prevent="form.post('/register')">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="name" class="label">Your Name</label>
                <input id="name" v-model="form.name" type="text" class="input" />
                <div v-if="form.errors.name" class="input-error">
                    {{
                        form.errors.name }}
                </div>
            </div>
            <div class="mt-4">
                <label for="email" class="label">E-mail</label>
                <input id="email" v-model="form.email" type="text" class="input" />
                <div v-if="form.errors.email" class="input-error">
                    {{
                        form.errors.email }}
                </div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input id="password" v-model="form.password" type="password" class="input" />
                <div v-if="form.errors.password" class="input-error">
                    {{ form.errors.password }}
                </div>
            </div>
            <div class="mt-4">
                <label for="password_confirmation" class="label">Confirm Password</label>
                <input id="password_confirmation" v-model="form.password_confirmation" type="password" class="input" />
            </div>
            <div class="mt-16">
                <button class="primary-btn w-full" type="submit">
                    Create Account
                </button>
            </div>
        </div>
    </form>
    <div class="mt-4 text-center dark:text-white">
        <Link href="/login" class="text-sm py-1 px-4">Already register? Click here!</Link>
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