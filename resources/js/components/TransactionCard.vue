<template>
  <div class="flex items-center gap-3 p-3 md:gap-4 md:p-4 bg-slate-900 hover:bg-slate-800/70 transition-colors duration-200 border-b border-slate-700 last:border-b-0">

    <div :class="['p-2 md:p-3 rounded-full flex-shrink-0', iconBgClass, iconTextColor]">
      <i :class="['text-xl md:text-2xl pi', transaction.category?.icon?.class ?? 'pi-question-circle']"></i>
    </div>

    <div class="flex-1 min-w-0 flex flex-col">
      <h3 class="text-base md:text-lg font-semibold text-white truncate">
        {{ transaction.category?.name ?? 'Sem Categoria' }}
      </h3>
      <p class="text-sm md:text-base text-slate-400 truncate">
        {{ transaction.description || transaction.title || 'Sem descrição' }}
      </p>
      <span class="text-xs md:text-sm font-medium text-slate-500 mt-0.5 md:mt-1">
        {{ formattedDate }}
      </span>
    </div>

    <p class="text-base md:text-lg font-semibold flex-shrink-0 ml-2 md:ml-4 min-w-[100px] sm:min-w-[120px] text-right" :class="amountTextColor">
      {{ isExpense ? '-' : '+' }} R$ {{ formattedAmount }}
    </p>

    <div class="flex items-center space-x-0.5 ml-1 sm:ml-2 flex-shrink-0">
      <button
        class="p-2 rounded-lg text-amber-400 hover:bg-amber-900/30 transition-colors duration-200"
        @click.stop="$emit('edit', transaction.id)"
        title="Editar"
      >
        <i class="pi pi-pencil text-sm md:text-base"></i>
      </button>

      <button
        class="p-2 rounded-lg text-rose-400 hover:bg-rose-900/30 transition-colors duration-200"
        @click.stop="$emit('delete', transaction.id)"
        title="Excluir"
      >
        <i class="pi pi-trash text-sm md:text-base"></i>
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
      required: true
    }
  },
  computed: {
    formattedAmount() {
      const valueAsNumber = parseFloat(this.transaction.amount) || 0
      return valueAsNumber.toFixed(2).replace('.', ',')
    },
    formattedDate() {
      if (!this.transaction.date) {
        return '';
      }
      try {
        const parts = this.transaction.date.split('-');
        if (parts.length !== 3) return this.transaction.date;

        const dateObj = new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));

        return dateObj.toLocaleDateString('pt-BR', {
          day: '2-digit',
          month: '2-digit',
          year: 'numeric'
        });
      } catch (e) {
        console.error("Erro ao formatar a data:", e);
        return this.transaction.date;
      }
    },
    isExpense() {
      return this.transaction.type === 'expense'
    },
    amountTextColor() {
      return this.isExpense ? 'text-rose-400' : 'text-emerald-400'
    },
    iconTextColor() {
      return this.isExpense ? 'text-rose-400' : 'text-emerald-400'
    },
    iconBgClass() {
      return this.isExpense ? 'bg-rose-900/40' : 'bg-emerald-900/40'
    }
  }
}
</script>

<style scoped>
/* Nenhum estilo extra necessário, Tailwind CSS faz todo o trabalho */
</style>
