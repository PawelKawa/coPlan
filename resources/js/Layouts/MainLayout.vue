
<template>
  <Link href="/">
    Home
  </Link>
  <Link href="/login">
    Login
  </Link>
   <p class="bg-red-500">
     This is MainLayout below is slot for content
   </p> 
   <main class="bg-gray-600">
     <slot />
   </main>
  <p class="bg-red-500">above is slot for content bg-gray-600</p>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

</script>