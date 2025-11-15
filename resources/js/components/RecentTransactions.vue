<template>
  <div class="w-full bg-slate-700/20 border border-slate-600 rounded-xl shadow-lg p-6 flex flex-col backdrop-blur-sm">
    <h3 class="text-lg font-semibold text-white mb-4">Últimas Transações</h3>

    <div class="flow-root">
      <ul role="list" class="-my-4 divide-y divide-slate-700">

        <li v-for="transacao in displayedTransactions" :key="transacao.id" class="flex items-center justify-between py-4">
          <div class="flex items-center gap-4">
            <span class="flex items-center justify-center w-10 h-10 rounded-full bg-slate-700">
              <svg v-if="transacao.tipo === 'Gasto'" class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.3-4.3 6.9 6.9L21.75 12" />
              </svg>
              <svg v-else class="w-6 h-6 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6L9 12.75l4.3 4.3 6.9-6.9L21.75 12" />
              </svg>
            </span>
            <div>
              <p class="text-sm font-medium text-white truncate">{{ transacao.nome }}</p>
              <p class="text-xs text-slate-400 truncate">{{ transacao.categoria }}</p>
            </div>
          </div>

          <div class="text-right">
            <p
              class="text-sm font-semibold"
              :class="transacao.tipo === 'Gasto' ? 'text-red-500' : 'text-emerald-500'"
            >
              {{ transacao.tipo === 'Gasto' ? '-' : '+' }} {{ formatCurrency(transacao.valor) }}
            </p>
            <p class="text-xs text-slate-400">{{ transacao.data }}</p>
          </div>
        </li>

      </ul>
    </div>

    <div class="mt-6 pt-4 text-center border-t border-slate-700">
      <button class="text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors">
        Ver todas as transações
      </button>
    </div>

  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const transacoes = ref([
  { id: 1, nome: 'Salário', categoria: 'Receita', tipo: 'Ganho', valor: 5000, data: '05 de nov' },
  { id: 2, nome: 'Aluguel', categoria: 'Moradia', tipo: 'Gasto', valor: 1250, data: '05 de nov' },
  { id: 3, nome: 'Supermercado', categoria: 'Alimentação', tipo: 'Gasto', valor: 480.50, data: '04 de nov' },
  { id: 4, nome: 'iFood', categoria: 'Alimentação', tipo: 'Gasto', valor: 65.00, data: '03 de nov' },
  { id: 5, nome: 'Cinema', categoria: 'Lazer', tipo: 'Gasto', valor: 80.00, data: '03 de nov' },
]);

const displayedTransactions = computed(() => {
  return transacoes.value.slice(0, 4);
});

const formatCurrency = (value) => {
  return value.toLocaleString('pt-BR', {
    style: 'currency',
    currency: 'BRL',
  });
};
</script>
