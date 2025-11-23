<template>
    <Layout>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
            <TotalBalance :balance="totalBalance" :is-visible="isSharedBalanceVisible"
                @toggle-visibility="toggleSharedVisibility" />
            <TotalIncome :income="totalIncome" :is-visible="isSharedBalanceVisible" />
            <TotalExpense :expense="totalExpense" :is-visible="isSharedBalanceVisible" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
            <QuickActions :categories="props.categories" />
            <RecentTransactions :transactions="props.recentTransactions" :categories="props.categories" />

            <TransactionChart :transactions="props.transactions" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <CreditCardWidget />
            <GoalsCard />
            <InvestmentCard />

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
import TransactionChart from '../components/TransactionChart.vue'
import CreditCardWidget from '../components/CreditCardWidget.vue'
import GoalsCard from '../components/GoalsCard.vue'
import InvestmentCard from '../components/InvestmentCard.vue'

const props = defineProps({
    categories: Array,
    recentTransactions: Array,
    transactions: Array
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
