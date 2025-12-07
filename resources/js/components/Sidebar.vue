<template>
    <div v-if="isOpen" @click="$emit('closeMenu')"
        class="lg:hidden fixed inset-0 z-30 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>

    <aside class="w-60 flex-shrink-0 p-6 flex flex-col justify-between
                fixed top-0 left-0 h-screen z-40 transition-transform duration-300 ease-in-out
                lg:relative lg:h-screen lg:z-auto lg:translate-x-0
                bg-slate-800/30 text-slate-300 backdrop-blur-sm
                lg:border-r lg:border-slate-600" :class="isOpen ? 'translate-x-0' : '-translate-x-full'">
        <div>
            <h1 class="text-2xl font-bold text-white mb-6">FinTrack</h1>

            <nav class="flex flex-col gap-4">

                <Link href="/dashboard"
                    class="flex items-center gap-3 p-3 rounded-lg text-slate-300 hover:bg-blue-600 hover:text-white transition-colors"
                    :class="{ 'bg-blue-600 text-white': $page.url.startsWith('/dashboard') }">
                <i class="pi pi-home"></i>
                <span>Dashboard</span>
                </Link>

                <Link href="/transactions"
                    class="flex items-center gap-3 p-3 rounded-lg text-slate-300 hover:bg-blue-600 hover:text-white transition-colors"
                    :class="{ 'bg-blue-600 text-white': $page.url.startsWith('/transactions') }">
                <i class="pi pi-chart-line"></i>
                <span>Transações</span>
                </Link>

                <Link href="/profile"
                    class="flex items-center gap-3 p-3 rounded-lg text-slate-300 hover:bg-blue-600 hover:text-white transition-colors"
                    :class="{ 'bg-blue-600 text-white': $page.url.startsWith('/profile') }">
                <i class="pi pi-user"></i>
                <span>Perfil</span>
                </Link>
                <div class="mb-8">
                    <button @click="isTransactionModalOpen = true"
                        class="w-full flex items-center justify-center gap-2 p-3 rounded-lg bg-blue-700/80 hover:bg-blue-500 text-white font-medium transition-all hover:shadow-blue-600/30">
                        <i class="pi pi-plus font-bold"></i>
                        <span>Nova Transação</span>
                    </button>
                </div>

            </nav>
        </div>

        <div class="pt-4 border-t border-slate-700/50 flex flex-col gap-3">
            <div class="flex items-center gap-3 p-3 rounded-lg bg-slate-900/40 border border-slate-700/50">
                <div
                    class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-white flex-shrink-0">
                    <span class="font-bold text-sm">{{ user?.name?.charAt(0).toUpperCase() || 'U' }}</span>
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-medium text-white truncate">{{ user?.name || 'Usuário' }}</p>
                </div>
            </div>

            <Link as="button" method="post" href="/logout"
                class="w-full flex items-center justify-center gap-2 p-2.5 rounded-lg text-sm font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-colors">
            <i class="pi pi-sign-out"></i>
            Sair da Conta
            </Link>
        </div>
    </aside>

    <Modal v-model="isTransactionModalOpen">
        <template #header>
            <div class="flex items-center gap-3">
                <i class="pi pi-money-bill text-blue-300"></i>
                <h3 class="text-lg font-semibold text-white">
                    Registrar Nova Transação
                </h3>
            </div>
        </template>

        <TransactionForm :categories="categories" :icons="icons" @close="isTransactionModalOpen = false"
            @save="handleTransactionSave" />
    </Modal>
</template>

<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3'
import Modal from './Modal.vue';
import TransactionForm from './TransactionForm.vue';

const page = usePage()
const user = page.props.auth?.user || null

const props = defineProps({
    isOpen: Boolean,
    categories: Array,
    icons: Array
})

defineEmits(['closeMenu'])

const isTransactionModalOpen = ref(false);

const handleTransactionSave = (formData) => {
    isTransactionModalOpen.value = false;
};
</script>
