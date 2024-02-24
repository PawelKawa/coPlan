<template>
    <div>
        <div class="w-60 mx-auto bg-green-200">
            <div>
                <label for="username">username</label>
                <input type="text" id="username" class="border">
            </div>
            <div>
                <label for="password">password</label>
                <input type="password" id="password" class="border">
            </div>
        </div>
    </div>
</template>

<script setup>

defineProps({
    //message is writen in backend indexController
    message: String,
})

</script>

