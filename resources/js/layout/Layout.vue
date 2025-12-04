<template>
    <div class="flex h-screen w-full bg-slate-950 text-slate-300 overflow-hidden">

        <Sidebar :isOpen="isMobileMenuOpen" @close-menu="isMobileMenuOpen = false" />

        <div class="flex flex-1 flex-col h-full relative">

            <Navbar @toggle-menu="isMobileMenuOpen = true" />

            <main class="flex-1 overflow-y-auto pt-20 lg:pt-0">

                <div class="w-full p-4 mx-auto max-w-7xl lg:p-6 lg:max-w-none lg:mx-0">
                    <slot />
                </div>
            </main>
            <div class="max-w-sm ml-auto w-full mx-2">
                <FlashMessage />
            </div>

        </div>


    </div>
</template>

<script setup>
import { ref } from 'vue';

const isMobileMenuOpen = ref(false);

import Sidebar from '../components/Sidebar.vue';
import Navbar from '../components/Navbar.vue';
import FlashMessage from '../components/FlashMessage.vue';
</script>
