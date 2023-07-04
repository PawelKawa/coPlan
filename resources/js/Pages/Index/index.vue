<template>
  <p class="text-3xl font-bold underline">Main page</p>
  <p>The message is: {{ message }}</p>
</template>

<script setup>
// import MainLayout from '../../Layouts/MainLayout.vue'
// import MainLayout from '@/Layouts/MainLayout.vue'

// defineProps(['message'])
defineProps({
    //message is writen in backend indexController
    message: String,
})

</script>

<!-- Loading something like presistent Layouts and thanks to that timer is not restarting when swaping pages. -->
<script>
import MainLayout from '@/Layouts/MainLayout.vue'
export default {
    layout: MainLayout,
}
</script>