<template>
  <div class="flex h-screen bg-slate-900 text-gray-300">

    <Sidebar :isOpen="isMobileMenuOpen" @close-menu="isMobileMenuOpen = false" />
    <Navbar @toggle-menu="isMobileMenuOpen = true" />

    <main class="w-full lg:flex-1 p-8 lg:p-12 overflow-y-auto pt-20 lg:pt-12">
      <h2 class="text-3xl font-semibold text-white mb-8">Dashboard</h2>

      <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

        <div class="lg:col-span-2 flex flex-col gap-8">
          <TotalBalance :balance="totalBalance" />
          <TransactionForm />
        </div>

        <div class="lg:col-span-3 flex flex-col gap-8">
          <TransactionChart />
          <RecentTransactions />
        </div>

      </div>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import Sidebar from '../components/Sidebar.vue';
import Navbar from '../components/Navbar.vue'; // Importe o Navbar
import TotalBalance from '../components/TotalBalance.vue';
import TransactionForm from '../components/TransactionForm.vue';
import TransactionChart from '../components/TransactionChart.vue';
import RecentTransactions from '../components/RecentTransactions.vue';

const isMobileMenuOpen = ref(false);
const totalBalance = ref(5000.00);
</script>
