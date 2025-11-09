<template>
  <div class_alias="w-full bg-slate-800 rounded-lg shadow-lg p-6">
    <h3 class="text-xl font-semibold text-white mb-6">Últimas Transações</h3>

    <div class="flex flex-col gap-4">
      <div
        v-for="transacao in transacoes"
        :key="transacao.id"
        class="flex items-center justify-between"
      >
        <div class="flex items-center gap-3">
          <span class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-700">
            <svg v-if="transacao.tipo === 'Gasto'" class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            <svg v-else class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.105 0 2 .895 2 2s-.895 2-2 2-2 .895-2 2 .895 2 2 2m0-8V6m0 16v-2"></path></svg>
          </span>
          <div>
            <p class="font-medium text-white">{{ transacao.nome }}</p>
            <p class="text-sm text-gray-400">{{ transacao.categoria }}</p>
          </div>
        </div>

        <span
          class="font-medium"
          :class="transacao.tipo === 'Gasto' ? 'text-red-500' : 'text-emerald-500'"
        >
          {{ transacao.tipo === 'Gasto' ? '-' : '+' }} {{ formatCurrency(transacao.valor) }}
        </span>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

// Dados falsos de exemplo
const transacoes = ref([
  { id: 1, nome: 'Salário', categoria: 'Ganho', tipo: 'Ganho', valor: 5000 },
  { id: 2, nome: 'Aluguel', categoria: 'Moradia', tipo: 'Gasto', valor: 1250 },
  { id: 3, nome: 'Supermercado', categoria: 'Alimentação', tipo: 'Gasto', valor: 480.50 },
  { id: 4, nome: 'iFood', categoria: 'Alimentação', tipo: 'Gasto', valor: 65.00 },
]);

const formatCurrency = (value) => {
  return value.toLocaleString('pt-BR', {
    style: 'currency',
    currency: 'BRL',
  });
};
</script>
