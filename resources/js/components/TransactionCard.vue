<template>
  <div class="p-5 rounded-2xl shadow-xl backdrop-blur-md border-2 bg-slate-800/30 border-slate-600 transition-all duration-300 hover:shadow-2xl">
    <div class="flex items-center justify-between mb-3">

      <div class="flex items-center space-x-3">
        <div :class="['p-2 rounded-full flex-shrink-0', iconBgClass, iconTextColor]">
          <i :class="['text-xl', transaction.icon]"></i>
        </div>

        <h3 class="text-xl font-semibold text-white truncate">
          {{ transaction.category }}
        </h3>
      </div>

      <p class="text-2xl font-bold flex-shrink-0 ml-4" :class="amountTextColor">
        {{ isExpense ? '-' : '+' }} R$ {{ formattedAmount }}
      </p>
    </div>

    <hr class="border-t border-slate-700 my-3" />

    <div class="flex justify-between items-center mb-4">
      <p class="text-base text-slate-300 truncate mr-4">
        {{ transaction.description }}
      </p>

      <span class="text-sm font-medium text-slate-400 flex-shrink-0">
        {{ transaction.date }}
      </span>
    </div>

    <div class="flex space-x-3 justify-end">

      <button
        class="flex items-center px-4 py-2 text-sm font-semibold rounded-lg
               text-amber-400 hover:bg-amber-900/30 transition-colors duration-200"
        @click="$emit('edit', transaction.id)"
      >
        <i class="pi pi-pencil mr-1"></i>
        Editar
      </button>

      <button
        class="flex items-center px-4 py-2 text-sm font-semibold rounded-lg
               text-rose-400 hover:bg-rose-900/30 transition-colors duration-200"
        @click="$emit('delete', transaction.id)"
      >
        <i class="pi pi-trash mr-1"></i>
        Excluir
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TransactionCard',
  props: {
    transaction: {
      type: Object,
      required: true,
      default: () => ({
        id: 1,
        category: 'Desconhecida',
        description: 'Transação sem descrição.',
        amount: 0.00,
        date: 'Hoje',
        type: 'expense',
        icon: 'pi pi-question-circle'
      })
    }
  },
  computed: {
    formattedAmount() {
      return this.transaction.amount.toFixed(2).replace('.', ',');
    },
    isExpense() {
      return this.transaction.type === 'expense';
    },

    amountTextColor() {
      return this.isExpense ? 'text-rose-400' : 'text-emerald-400';
    },

    iconTextColor() {
      return this.isExpense ? 'text-rose-400' : 'text-emerald-400';
    },

    iconBgClass() {
      return this.isExpense ? 'bg-rose-900/40' : 'bg-emerald-900/40';
    }
  }
}
</script>
