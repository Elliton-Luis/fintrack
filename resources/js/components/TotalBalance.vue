<template>
  <div class="rounded-lg w-full shadow-lg p-4 h-28
              border border-slate-600 bg-slate-700/20 backdrop-blur-sm
              flex flex-col justify-between">

    <div class="flex items-center justify-between">
      <h3 class="text-lg font-semibold text-white">Saldo total</h3>

      <button @click="emitToggle" class="text-gray-300 hover:text-white p-1 -mt-1 -mr-1">
        <i class="pi" :class="isVisible ? 'pi-eye' : 'pi-eye-slash'"></i>
      </button>
    </div>

    <p class="text-2xl font-bold text-white">
      <span v-if="isVisible">{{ formattedBalance }}</span>
      <span v-else>R$ ••••••</span>
    </p>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  balance: {
    type: Number,
    default: 0,
  },
  isVisible: {
    type: Boolean,
    default: true,
  }
});

const emit = defineEmits(['toggle-visibility']);

const emitToggle = () => {
  emit('toggle-visibility');
};

const formattedBalance = computed(() => {
  return props.balance.toLocaleString('pt-BR', {
    style: 'currency',
    currency: 'BRL',
  });
});
</script>
