<template>
  <div class="w-full bg-slate-800 rounded-lg shadow-lg p-6">
    <h3 class="text-xl font-semibold text-white mb-2">Saldo total</h3>
    <p class="text-3xl font-bold text-white">
      {{ formattedBalance }}
    </p>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  balance: {
    type: Number,
    default: 0,
  }
});

const formattedBalance = computed(() => {
  return props.balance.toLocaleString('pt-BR', {
    style: 'currency',
    currency: 'BRL',
  });
});
</script>
