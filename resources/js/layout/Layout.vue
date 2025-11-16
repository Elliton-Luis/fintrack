<template>
  <div class="flex h-screen bg-slate-950 text-slate-300">

    <Sidebar :isOpen="isMobileMenuOpen" @close-menu="isMobileMenuOpen = false" />

    <Navbar @toggle-menu="isMobileMenuOpen = true" />

    <FlashMessage :message="$page.props.flash?.success" />

    <main class="flex-1 overflow-y-auto pt-24 lg:pt-16">
      <div class="min-h-screen p-6 lg:p-8">
        <slot />
      </div>
    </main>

  </div>
</template>

<script setup>
import { ref } from 'vue';

const isMobileMenuOpen = ref(false);

import Sidebar from '../components/Sidebar.vue';
import Navbar from '../components/Navbar.vue';
import FlashMessage from '../components/FlashMessage.vue';
</script>
