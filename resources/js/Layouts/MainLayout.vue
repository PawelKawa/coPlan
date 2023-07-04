
<template>
  <Link class="text-red-500" href="/">
    Go to Main page
  </Link>&nbsp;
  <Link class="text-red-500" href="/second">
    Go to second page
  </Link>&nbsp;
  <p>{{ timer }}</p>
    
  <slot />
</template>

<script setup>
import {ref} from 'vue'

const timer = ref(0)
setInterval(() => timer.value++, 1000)
defineExpose({ timer })
</script>