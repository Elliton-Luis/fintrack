<template>
  <div class="w-full bg-slate-800 rounded-lg shadow-lg p-6">
    <div class="flex items-center justify-between mb-2">
      <h3 class="text-xl font-semibold text-white">Saldo total</h3>
      <button @click="toggleVisibility" class="text-gray-400 hover:text-white p-2">
        <i class="pi" :class="isBalanceVisible ? 'pi-eye' : 'pi-eye-slash'"></i>
      </button>
    </div>

    <p class="text-3xl font-bold text-white h-[40px]">
      <span v-if="isBalanceVisible">{{ formattedBalance }}</span>
      <span v-else>R$ ••••••</span>
    </p>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
  balance: {
    type: Number,
    default: 0,
  }
});

const isBalanceVisible = ref(true);

const formattedBalance = computed(() => {
  return props.balance.toLocaleString('pt-BR', {
    style: 'currency',
    currency: 'BRL',
  });
});

const toggleVisibility = () => {
  isBalanceVisible.value = !isBalanceVisible.value;
};
</script>
