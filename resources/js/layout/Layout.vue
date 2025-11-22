<template>
  <div class="flex h-screen w-full bg-slate-950 text-slate-300 overflow-hidden">

    <!-- Sidebar -->
    <Sidebar :isOpen="isMobileMenuOpen" @close-menu="isMobileMenuOpen = false" />

    <div class="flex flex-1 flex-col h-full relative">

      <!-- Navbar -->
      <Navbar @toggle-menu="isMobileMenuOpen = true" />

      <!-- Mensagens Flash -->
      <FlashMessage :message="$page.props.flash?.success" />

      <!--
        Área Principal
        Correção do Topo: Adicionei 'pt-20' para empurrar o conteúdo para baixo em telas móveis,
        livrando-o da Navbar fixa. Em telas grandes (lg), removemos esse padding extra (lg:pt-0)
        assumindo que a Navbar se comporta corretamente no layout desktop.
      -->
      <main class="flex-1 overflow-y-auto pt-20 lg:pt-0">

        <!--
           LÓGICA HÍBRIDA DE LARGURA:
           1. Telas Pequenas (< lg): 'max-w-7xl mx-auto' (Centralizado e contido).
           2. Telas Grandes (>= lg): 'lg:max-w-none lg:mx-0' (Fluido, ocupando tudo).
        -->
        <div class="w-full p-4 mx-auto max-w-7xl lg:p-6 lg:max-w-none lg:mx-0">
          <slot />
        </div>
      </main>

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
