<template>
  <div class="rounded-lg w-full shadow-lg p-4 h-28
              border border-emerald-500 bg-emerald-500/20 backdrop-blur-sm
              flex flex-col justify-between">
    <div class="flex items-center">
      <h3 class="text-lg font-semibold text-white">Total de Entradas </h3>
    </div>
    <p class="text-2xl font-bold text-white">
      <span v-if="isVisible">{{ formattedIncome }}</span>
      <span v-else>R$ ••••••</span>
    </p>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  income: {
    type: Number,
    default: 0
  },
  isVisible: {
    type: Boolean,
    default: true
  }
});

const formattedIncome = computed(() => {
  return props.income.toLocaleString('pt-BR', {
    style: 'currency',
    currency: 'BRL',
  });
});
</script>
