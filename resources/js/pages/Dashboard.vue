<template>
    <div class="flex h-screen bg-slate-950 text-slate-300">

        <!-- Sidebar -->
        <Sidebar
            :isOpen="isMobileMenuOpen"
            @close-menu="isMobileMenuOpen = false"
        />

        <!-- Navbar -->
        <Navbar @toggle-menu="isMobileMenuOpen = true" />

        <!-- MAIN -->
        <main class="flex-1 overflow-y-auto pt-24 lg:pt-16">
            <div class="min-h-screen p-6 lg:p-8">

                <!-- ===================================== -->
                <!-- LINHA 1: Totais (3 colunas responsivas) -->
                <!-- ===================================== -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                    <TotalBalance
                        :balance="totalBalance"
                        :is-visible="isSharedBalanceVisible"
                        @toggle-visibility="toggleSharedVisibility"
                    />
                    <TotalIncome
                        :income="totalIncome"
                        :is-visible="isSharedBalanceVisible"
                    />
                    <TotalExpense
                        :expense="totalExpense"
                        :is-visible="isSharedBalanceVisible"
                    />
                </div>

                <!-- ===================================== -->
                <!-- LINHA 2: Ações / Transações / Gráfico -->
                <!-- 3 colunas, responsivas, sem sobreposição -->
                <!-- ===================================== -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                    <QuickActions />
                    <RecentTransactions />
                    <TransactionChart />
                </div>

            </div>
        </main>

    </div>
</template>


<script setup>
import { ref } from 'vue';

import Sidebar from '../components/Sidebar.vue';
import Navbar from '../components/Navbar.vue';

import TotalBalance from '../components/TotalBalance.vue';
import TotalIncome from '../components/TotalIncome.vue';
import TotalExpense from '../components/TotalExpense.vue';

import QuickActions from '../components/QuickActions.vue';
import RecentTransactions from '../components/RecentTransactions.vue';
import TransactionChart from '../components/TransactionChart.vue';

const isMobileMenuOpen = ref(false);

const totalIncome = 7500.00;
const totalExpense = 2500.00;
const totalBalance = totalIncome - totalExpense;

const isSharedBalanceVisible = ref(true);

const toggleSharedVisibility = () => {
    isSharedBalanceVisible.value = !isSharedBalanceVisible.value;
};
</script>
