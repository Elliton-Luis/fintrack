<template>
  <Layout>
    <div id="app" class="p-4 md:p-8 min-h-screen bg-slate-950">

      <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-3xl font-bold text-white">
          Minhas Transações
        </h1>

        <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">

          <div class="relative w-full md:w-56">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
              <i class="pi pi-search text-sm"></i>
            </div>

            <input
              type="text"
              v-model="searchQuery"
              placeholder="Buscar..."
              class="w-full appearance-none bg-slate-800/50 border border-slate-600 text-white
                     py-2.5 pl-10 pr-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500
                     transition-colors shadow-lg backdrop-blur-sm placeholder-slate-400"
            />
          </div>

          <div class="relative w-full md:w-48">
            <select
              v-model="filterType"
              class="w-full appearance-none bg-slate-800/50 border border-slate-600 text-white
                     py-2.5 pl-4 pr-10 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500
                     cursor-pointer hover:bg-slate-800/70 transition-colors shadow-lg backdrop-blur-sm"
            >
              <option value="all" class="bg-slate-900">Todas</option>
              <option value="income" class="bg-slate-900">Entradas</option>
              <option value="expense" class="bg-slate-900">Saídas</option>
            </select>

            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
              <i class="pi pi-filter text-sm"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <TransactionCard
          v-for="trans in filteredTransactions"
          :key="trans.id"
          :transaction="trans"
          @edit="handleEdit"
          @delete="handleDelete"
        />
      </div>

      <div v-if="filteredTransactions.length === 0" class="flex flex-col items-center justify-center py-12 text-slate-500">
        <div class="p-4 rounded-full bg-slate-800/50 mb-3">
            <i class="pi pi-search text-3xl"></i>
        </div>
        <p class="text-lg font-medium">Nenhuma transação encontrada.</p>
      </div>

    </div>
  </Layout>
</template>

<script>
import TransactionCard from '../components/TransactionCard.vue';
import Layout from '../layout/Layout.vue';

export default {
  components: {
    TransactionCard,
    Layout
  },
  data() {
    return {
      filterType: 'all',
      searchQuery: '', // Estado para a barra de pesquisa
      transactions: [
        { id: 1, category: 'Aluguel', description: 'Mensalidade de Outubro.', amount: 1500.00, date: '01/Out', type: 'expense', icon: 'pi pi-home' },
        { id: 2, category: 'Salário', description: 'Pagamento Fim de Mês.', amount: 4800.00, date: '30/Out', type: 'income', icon: 'pi pi-wallet' },
        { id: 3, category: 'Compras', description: 'Nova camisa e tênis.', amount: 250.90, date: '05/Nov', type: 'expense', icon: 'pi pi-shopping-bag' },
        { id: 4, category: 'Freelance', description: 'Projeto de Design.', amount: 650.00, date: '12/Nov', type: 'income', icon: 'pi pi-briefcase' },
        { id: 5, category: 'Assinaturas', description: 'Netflix + Spotify.', amount: 89.90, date: '15/Nov', type: 'expense', icon: 'pi pi-refresh' },
        { id: 6, category: 'Alimentação', description: 'Jantar com amigos.', amount: 145.50, date: '15/Nov', type: 'expense', icon: 'pi pi-book' },
        { id: 7, category: 'Investimentos', description: 'Dividendos recebidos.', amount: 125.70, date: '16/Nov', type: 'income', icon: 'pi pi-chart-line' },
        { id: 8, category: 'Saúde', description: 'Consulta Odontológica.', amount: 180.00, date: '16/Nov', type: 'expense', icon: 'pi pi-heart' },
      ]
    }
  },
  computed: {
    // A lógica de filtro agora combina o tipo E a pesquisa
    filteredTransactions() {
      let filtered = this.transactions;

      // 1. Aplicar filtro de tipo (all, income, expense)
      if (this.filterType !== 'all') {
        filtered = filtered.filter(t => t.type === this.filterType);
      }

      // 2. Aplicar filtro de pesquisa (sobre o resultado anterior)
      if (this.searchQuery) {
        const query = this.searchQuery.toLowerCase();
        filtered = filtered.filter(t =>
          t.category.toLowerCase().includes(query) ||
          t.description.toLowerCase().includes(query)
        );
      }

      return filtered;
    }
  },
  methods: {
    handleEdit(id) {
      console.log(`Editar transação com ID: ${id}`);
    },
    handleDelete(id) {
      console.log(`Excluir transação com ID: ${id}`);
    }
  }
}
</script>
