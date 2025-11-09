<template>
  <nav
    class="lg:hidden fixed top-0 left-0 right-0 z-20
           flex items-center justify-between p-4 h-16
           bg-slate-950 border-b border-slate-800"
  >
    <h1 class="text-xl font-bold text-white">FinTrack</h1>
    <button @click="$emit('toggleMenu')" class="p-2 text-gray-300 hover:text-white">
      <i class="pi pi-bars text-xl"></i>
    </button>
  </nav>
</template>

<script setup>
defineEmits(['toggleMenu']);
</script>
