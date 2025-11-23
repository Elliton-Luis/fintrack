<template>
    <Layout>
        <div id="app" class="p-4 md:p-8 min-h-screen bg-slate-950">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <h1 class="text-3xl font-bold text-white">Minhas Transações</h1>
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                    <div class="relative w-full md:w-48">
                         <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                             <i class="pi pi-search text-sm"></i>
                         </div>
                         <input type="text" v-model="searchQuery" placeholder="Buscar..."
                             class="w-full appearance-none bg-slate-800/50 border border-slate-600 text-white py-2.5 pl-10 pr-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors shadow-lg backdrop-blur-sm placeholder-slate-400" />
                     </div>

                     <div class="relative w-full md:w-40">
                         <select v-model="filterType"
                             class="w-full appearance-none bg-slate-800/50 border border-slate-600 text-white py-2.5 pl-4 pr-10 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer hover:bg-slate-800/70 transition-colors shadow-lg backdrop-blur-sm">
                             <option value="all">Todos Tipos</option>
                             <option value="income">Entradas</option>
                             <option value="expense">Saídas</option>
                         </select>
                         <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                             <i class="pi pi-filter text-sm"></i>
                         </div>
                     </div>

                     <div class="relative w-full md:w-44">
                         <select v-model="sortType"
                             class="w-full appearance-none bg-slate-800/50 border border-slate-600 text-white py-2.5 pl-4 pr-10 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer hover:bg-slate-800/70 transition-colors shadow-lg backdrop-blur-sm">
                             <option value="recent">Mais Recentes</option>
                             <option value="highest">Maior Valor</option>
                         </select>
                         <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                             <i class="pi pi-sort-alt text-sm"></i>
                         </div>
                     </div>
                 </div>
            </div>

            <div v-if="loading" class="text-slate-400">Carregando...</div>

            <div v-else>
                <div class="rounded-2xl overflow-hidden shadow-lg">
                    <TransactionCard v-for="(trans, index) in filteredTransactions"
                        :key="trans.id ?? index"
                        :transaction="trans"
                        @edit="handleEdit"
                        @delete="handleDelete" />
                </div>

                <div v-if="filteredTransactions.length === 0"
                    class="flex flex-col items-center justify-center py-12 text-slate-500">
                    <div class="p-4 rounded-full bg-slate-800/50 mb-3">
                        <i class="pi pi-search text-3xl"></i>
                    </div>
                    <p class="text-lg font-medium">Nenhuma transação encontrada nesta página.</p>
                </div>

                <div v-if="transactions.links" class="mt-6 flex justify-center">
                     <Pagination :links="transactions.links" />
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
// O script permanece igual ao que você enviou
import { ref, computed } from 'vue'
import Layout from '../layout/Layout.vue'
import TransactionCard from '../components/TransactionCard.vue'
import Pagination from '../components/Pagination.vue'

const props = defineProps({
    transactions: {
        type: Object,
        default: () => ({ data: [], links: [] })
    }
})

const loading = ref(true)
setTimeout(() => { loading.value = false }, 150)

const searchQuery = ref('')
const filterType = ref('all')
const sortType = ref('recent')

const transactionsList = computed(() => props.transactions?.data ?? [])

const filteredTransactions = computed(() => {
    let list = Array.isArray(transactionsList.value) ? transactionsList.value.slice() : []

    if (filterType.value !== 'all') {
        list = list.filter(t => (t && t.type) === filterType.value)
    }

    if (searchQuery.value && searchQuery.value.trim()) {
        const q = searchQuery.value.toLowerCase()
        list = list.filter(t =>
            (t?.category?.name ?? '').toString().toLowerCase().includes(q) ||
            (t?.description ?? '').toString().toLowerCase().includes(q) ||
            (t?.title ?? '').toString().toLowerCase().includes(q)
        )
    }

    list.sort((a, b) => {
        if (sortType.value === 'highest') {
            return parseFloat(b.amount) - parseFloat(a.amount)
        } else if (sortType.value === 'recent') {
            return new Date(b.transaction_date) - new Date(a.transaction_date)
        }
        return 0
    })

    return list
})

const handleEdit = id => console.log('[Transaction.vue] editar', id)
const handleDelete = id => console.log('[Transaction.vue] excluir', id)
</script>
