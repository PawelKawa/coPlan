<template>
    <p>Main page</p>
    <p>The message is: {{ message }}</p>
</template>

<script setup>

defineProps({
    //message is writen in backend indexController
    message: String,
})

</script>

