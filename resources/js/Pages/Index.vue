<template>
    <div>
        <Link href="/register">Register here</Link>
        <Link href="/login">Login here</Link>
        <Link href="/logout" method="delete" as="button">Logout</Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default{
    name: 'Homepage',
    components:{
        Link
    },

}
</script>

