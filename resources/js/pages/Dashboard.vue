<template>
    <Layout>
        <div class="flex flex-col h-full overflow-hidden">

            <div class="flex flex-col xl:flex-row items-center justify-between mb-4 gap-6 shrink-0">

                <div class="text-left">
                    <h1 class="text-2xl xl:text-3xl font-bold text-white tracking-tight">
                        Visão Geral
                    </h1>
                    <p class="text-stone-400 mt-1 text-xl xl:text-2xl">
                        Resumo de <span class="text-blue-50 font-bold capitalize">{{ props.month }}</span>
                    </p>
                </div>

                <div class="w-full grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <TotalBalance :balance="totalBalance" :is-visible="isSharedBalanceVisible"
                        @toggle-visibility="toggleSharedVisibility" />
                    <TotalIncome :income="totalIncome" :is-visible="isSharedBalanceVisible" />
                    <TotalExpense :expense="totalExpense" :is-visible="isSharedBalanceVisible" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-1 min-h-0 pb-0">

                <div class="h-full overflow-hidden">
                    <QuickActions :categories="props.categories" :icons="props.icons" />
                </div>

                <div class="h-full overflow-hidden">
                    <UpcomingBills :bills="props.upcomingBills" />
                </div>

                <div class="h-full overflow-hidden">
                    <ExpensesChart :transactions="props.transactions" />
                </div>

                <div class="h-full overflow-hidden">
                    <RecentTransactions :transactions="props.recentTransactions" :categories="props.categories" />
                </div>

            </div>

        </div>
    </Layout>
</template>

<script setup>
import { ref, computed } from 'vue'
import Layout from '../layout/Layout.vue'
import TotalBalance from '../components/TotalBalance.vue'
import TotalIncome from '../components/TotalIncome.vue'
import TotalExpense from '../components/TotalExpense.vue'
import QuickActions from '../components/QuickActions.vue'
import RecentTransactions from '../components/RecentTransactions.vue'
import UpcomingBills from '../components/UpcomingBills.vue'
import ExpensesChart from '../components/ExpensesChart.vue'

const props = defineProps({
    categories: Array,
    recentTransactions: Array,
    transactions: Array,
    upcomingBills: {
        type: Array,
        default: () => [
            { id: 1, title: 'Aluguel', amount: 1200.00, date: '2025-12-10' },
            { id: 2, title: 'Internet', amount: 150.00, date: '2025-12-06' },
            { id: 3, title: 'Academia', amount: 90.00, date: '2025-12-05' }
        ]
    },
    icons: Array,
    month: String
})

const totalIncome = computed(() =>
    (props.transactions ?? [])
        .filter(t => t.type === 'income')
        .reduce((sum, t) => sum + Number(t.amount), 0)
)

const totalExpense = computed(() =>
    (props.transactions ?? [])
        .filter(t => t.type === 'expense')
        .reduce((sum, t) => sum + Number(t.amount), 0)
)

const totalBalance = computed(() => totalIncome.value - totalExpense.value)

const isSharedBalanceVisible = ref(false)
const toggleSharedVisibility = () => {
    isSharedBalanceVisible.value = !isSharedBalanceVisible.value
}
</script>
