<template>
    <div class="w-full bg-slate-700/20 border border-slate-600 rounded-2xl shadow-lg p-6 backdrop-blur-sm h-full flex flex-col">

        <div class="flex items-center justify-between mb-5">
            <h3 class="text-lg font-semibold text-white">Ações Rápidas</h3>
        </div>

        <div class="flex flex-col gap-3 flex-1">

            <button @click="isTransactionModalOpen = true"
                class="group w-full p-4 rounded-xl flex items-center justify-between transition-all duration-300
                       bg-emerald-500/10 border border-emerald-500/20 hover:bg-emerald-500/20 hover:border-emerald-500/40">

                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center text-emerald-400 group-hover:text-emerald-300 group-hover:scale-110 transition-all duration-300">
                        <i class="pi pi-plus text-lg"></i>
                    </div>
                    <div class="flex flex-col items-start">
                        <span class="font-bold text-white group-hover:text-emerald-50 transition-colors">Nova Transação</span>
                        <span class="text-[15px] text-emerald-200/60 font-medium">Entrada ou Saída</span>
                    </div>
                </div>

                <i class="pi pi-chevron-right text-xs text-emerald-500/50 group-hover:translate-x-1 transition-transform"></i>
            </button>

            <div class="grid grid-cols-3 gap-3 h-full">

                <button class="flex flex-col items-center justify-center gap-2 p-3 rounded-xl border border-slate-700/50 bg-slate-800/30
                               hover:bg-slate-700/50 hover:border-slate-600 transition-all duration-200 group">
                    <i class="pi pi-chart-pie text-xl text-slate-400 group-hover:text-white transition-colors"></i>
                    <span class="text-[15px] font-medium text-slate-400 group-hover:text-slate-200">Relatórios</span>
                </button>

                <button class="flex flex-col items-center justify-center gap-2 p-3 rounded-xl border border-slate-700/50 bg-slate-800/30
                               hover:bg-slate-700/50 hover:border-slate-600 transition-all duration-200 group">
                    <i class="pi pi-cog text-xl text-slate-400 group-hover:text-white transition-colors"></i>
                    <span class="text-[15px] font-medium text-slate-400 group-hover:text-slate-200">Ajustes</span>
                </button>

                <button class="flex flex-col items-center justify-center gap-2 p-3 rounded-xl border border-slate-700/50 bg-slate-800/30
                               hover:bg-slate-700/50 hover:border-slate-600 transition-all duration-200 group">
                    <i class="pi pi-question-circle text-xl text-slate-400 group-hover:text-white transition-colors"></i>
                    <span class="text-[15px] font-medium text-slate-400 group-hover:text-slate-200">Ajuda</span>
                </button>

            </div>
        </div>
    </div>

    <Modal v-model="isTransactionModalOpen">
        <template #header>
            <div class="flex items-center gap-3">
                <i class="pi pi-money-bill text-emerald-400"></i>
                <h3 class="text-lg font-semibold text-white">
                    Registrar Nova Transação
                </h3>
            </div>
        </template>
        <TransactionForm :categories="props.categories" :icons="props.icons" @close="isTransactionModalOpen = false"
            @save="handleTransactionSave" />
    </Modal>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    categories: Array,
    icons: Array
});

import Modal from './Modal.vue';
import TransactionForm from './TransactionForm.vue';

const isTransactionModalOpen = ref(false);

const handleTransactionSave = (formData) => {
    console.log('Transação salva!', formData);
    isTransactionModalOpen.value = false;
};
</script>
