<template>
    <div class="w-full bg-slate-700/20 border border-slate-600 rounded-lg shadow-lg p-6 backdrop-blur-sm">

        <h3 class="text-xl font-semibold text-white mb-5">
            Ações Rápidas
        </h3>

        <div class="flex flex-col gap-3">

            <button @click="isTransactionModalOpen = true" class="w-full p-3 rounded-lg text-left text-white font-medium transition-all duration-200
               flex items-center gap-3
               bg-blue-600/70 hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-600/30">
                <i class="pi pi-plus w-5 text-center"></i>
                <span>Criar Transação</span>
            </button>

            <button class="w-full p-3 rounded-lg text-left text-white font-medium transition-all duration-200
                     flex items-center gap-3
                     bg-slate-600/50 hover:bg-slate-600/80">
                <i class="pi pi-chart-bar w-5 text-center"></i>
                <span>Ver Relatórios</span>
            </button>

            <button class="w-full p-3 rounded-lg text-left text-white font-medium transition-all duration-200
                     flex items-center gap-3
                     bg-slate-600/50 hover:bg-slate-600/80">
                <i class="pi pi-cog w-5 text-center"></i>
                <span>Configurações</span>
            </button>

            <button class="w-full p-3 rounded-lg text-left text-white font-medium transition-all duration-200
                     flex items-center gap-3
                     bg-slate-600/50 hover:bg-slate-600/80">
                <i class="pi pi-question-circle w-5 text-center"></i>
                <span>Ajuda</span>
            </button>

        </div>
    </div>

    <Modal v-model="isTransactionModalOpen">

        <template #header>
            <div class="flex items-center gap-3">
                <i class="pi pi-money-bill text-blue-300"></i>
                <h3 class="text-lg font-semibold text-white">
                    Registrar Nova Transação
                </h3>
            </div>
        </template>

        <TransactionForm :categories="props.categories" @close="isTransactionModalOpen = false"
            @save="handleTransactionSave" />

    </Modal>

</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    categories: Array
});

import Modal from './Modal.vue';
import TransactionForm from './TransactionForm.vue';

const isTransactionModalOpen = ref(false);

const handleTransactionSave = (formData) => {
    console.log('Transação salva no QuickActions!', formData);
    isTransactionModalOpen.value = false;
};
</script>
