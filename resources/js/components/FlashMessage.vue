<template>
  <div
    v-if="message"
    class="fixed top-4 left-1/2 -translate-x-1/2
           bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg z-[9999]">
    {{ message }}
  </div>
</template>

<script setup>
defineProps({
  message: {
    type: String,
    default: null
  }
})
</script>
