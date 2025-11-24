<template>
    <div class="w-full bg-slate-900/50 backdrop-blur-md border border-slate-800/50 rounded-2xl shadow-2xl p-6">
        <h3 class="text-2xl font-bold text-white mb-8">Nova Transação</h3>

        <form @submit.prevent="store" class="flex flex-col gap-6">

            <div class="flex justify-center gap-1 p-1 bg-slate-950/60 border border-slate-800 rounded-xl w-fit mx-auto shadow-sm">
                <label class="relative flex items-center cursor-pointer group px-6 py-2.5 rounded-lg transition-all duration-300"
                    :class="form.type === 'income' ? 'bg-emerald-500/10 shadow-[inset_0_0_10px_rgba(16,185,129,0.1)]' : 'hover:bg-slate-900/50'">
                    <input type="radio" v-model="form.type" value="income" class="sr-only peer" />
                    <div class="w-3 h-3 rounded-full border-2 border-slate-500 peer-checked:bg-emerald-400 peer-checked:border-emerald-400 transition-all scale-90 peer-checked:scale-110 peer-checked:shadow-emerald-500/50 peer-checked:shadow-sm"></div>
                    <span class="ml-3 font-medium text-slate-400 peer-checked:text-emerald-300 transition-colors">Ganho</span>
                </label>

                <label class="relative flex items-center cursor-pointer group px-6 py-2.5 rounded-lg transition-all duration-300"
                    :class="form.type === 'expense' ? 'bg-red-500/10 shadow-[inset_0_0_10px_rgba(239,68,68,0.1)]' : 'hover:bg-slate-900/50'">
                    <input type="radio" v-model="form.type" value="expense" class="sr-only peer" />
                    <div class="w-3 h-3 rounded-full border-2 border-slate-500 peer-checked:bg-red-400 peer-checked:border-red-400 transition-all scale-90 peer-checked:scale-110 peer-checked:shadow-red-500/50 peer-checked:shadow-sm"></div>
                    <span class="ml-3 font-medium text-slate-400 peer-checked:text-red-300 transition-colors">Gasto</span>
                </label>
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-slate-300 mb-2 pl-1">Nome</label>
                <input type="text" id="title" v-model="form.title"
                    class="block w-full bg-slate-950/50 border border-slate-800 rounded-xl py-3 px-4 text-slate-100 placeholder-slate-500 shadow-sm focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-slate-700 outline-none transition-all duration-200"
                    placeholder="Ex: Salário, Mercado..." />
                <div v-if="form.errors.title" class="text-red-400 text-xs mt-2 pl-1 font-medium">{{ form.errors.title }}</div>
            </div>

            <div>
                <label for="descricao" class="block text-sm font-medium text-slate-300 mb-2 pl-1">Descrição <span class="text-slate-500 text-xs font-normal ml-1">(Opcional)</span></label>
                <textarea id="descricao" v-model="form.description" rows="2"
                    class="block w-full bg-slate-950/50 border border-slate-800 rounded-xl py-3 px-4 text-slate-100 placeholder-slate-500 shadow-sm focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-slate-700 outline-none transition-all duration-200 resize-none"
                    placeholder="Detalhes adicionais..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2 pl-1">Categoria</label>
                <div class="flex items-center gap-3">
                    <div class="flex-grow">
                        <CategorySelect
                            v-model="form.category_id"
                            :options="filteredCategories"
                            placeholder="Selecione a categoria"
                            class="h-[46px]"
                        />
                    </div>

                    <button type="button" @click="showCategoryModal = true"
                        class="flex-shrink-0 w-[46px] h-[46px] flex items-center justify-center bg-slate-950/50 hover:bg-blue-500/10 border border-slate-800 hover:border-blue-500/50 rounded-xl transition-all duration-200 text-slate-400 hover:text-blue-400 group tooltip-container shadow-sm">
                        <i class="pi pi-plus text-sm group-hover:scale-110 transition-transform"></i>
                    </button>
                </div>
                <div v-if="form.errors.category_id" class="text-red-400 text-xs mt-2 pl-1 font-medium">{{ form.errors.category_id }}</div>
            </div>

            <div>
                <label for="amount" class="block text-sm font-medium text-slate-300 mb-2 pl-1">Valor</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-slate-400 font-medium select-none">R$</span>
                    <input type="number" id="amount" v-model="form.amount" step="0.01"
                        class="block w-full bg-slate-950/50 border border-slate-800 rounded-xl py-3 pl-12 pr-4 text-slate-100 placeholder-slate-500 shadow-sm focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-slate-700 outline-none transition-all duration-200 font-mono text-lg"
                        placeholder="0,00" />
                </div>
                <div v-if="form.errors.amount" class="text-red-400 text-xs mt-2 pl-1 font-medium">{{ form.errors.amount }}</div>
            </div>

            <div class="flex items-center gap-3 p-4 rounded-xl border border-slate-800/60 bg-slate-950/30 hover:bg-slate-950/50 transition-colors cursor-pointer" @click="form.isRecurring = !form.isRecurring">
                <div class="relative flex items-center justify-center shrink-0">
                    <input type="checkbox" id="recorrente" v-model="form.isRecurring"
                        class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border-2 border-slate-600 bg-slate-900/50 transition-all checked:border-blue-500 checked:bg-blue-500 checked:shadow-sm checked:shadow-blue-500/50 focus:ring-2 focus:ring-blue-500/40 focus:ring-offset-0" />
                    <i class="pi pi-check absolute text-[10px] text-white opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity font-bold"></i>
                </div>
                <label for="recorrente" class="text-sm text-slate-300 cursor-pointer select-none font-medium">Esta é uma transação recorrente?</label>
            </div>

            <div v-if="form.isRecurring" class="animate-fade-in-down">
                <label for="transaction_date" class="block text-sm font-medium text-slate-300 mb-2 pl-1">Data de Cobrança</label>
                <input type="date" id="transaction_date" v-model="form.transaction_date"
                    class="block w-full bg-slate-950/50 border border-slate-800 rounded-xl py-3 px-4 text-slate-100 focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-slate-700 outline-none transition-all duration-200 [color-scheme:dark] [&::-webkit-calendar-picker-indicator]:opacity-60 [&::-webkit-calendar-picker-indicator]:hover:opacity-100" />
            </div>

            <button type="submit" :disabled="form.processing"
                class="w-full bg-gradient-to-r from-blue-600 via-blue-700 to-blue-600 hover:from-blue-500 hover:to-blue-500 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-blue-900/20 hover:shadow-blue-600/30 transition-all duration-200 transform active:scale-[0.99] mt-4 flex justify-center items-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
                <i v-if="form.processing" class="pi pi-spinner pi-spin"></i>
                <span v-else>Registrar Transação</span>
            </button>
        </form>

        <Modal v-model="showCategoryModal">
            <CategoryForm
                :icons="props.icons"
                @success="onCategoryCreated"
                @close="showCategoryModal = false"
            />
        </Modal>
    </div>
</template>

<script setup>
// O SCRIPT NÃO MUDA NADA
import { ref, computed, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '../components/Modal.vue';
import CategoryForm from '../components/CategoryForm.vue';
import CategorySelect from '../components/CategorySelect.vue';

const emit = defineEmits(['transaction-registered']);

const props = defineProps({
    categories: { type: Array, default: () => [] },
    icons: { type: Array, default: () => [] }
});

const showCategoryModal = ref(false);

const form = useForm({
    type: 'expense',
    title: '',
    description: '',
    amount: '',
    category_id: null,
    isRecurring: false,
    transaction_date: new Date().toISOString().split('T')[0],
});

const filteredCategories = computed(() => {
    return props.categories.filter(category => category.type === form.type);
});

watch(() => form.type, () => {
    form.category_id = null;
});

const store = () => {
    form.post('/transactions', {
        preserveScroll: true,
        onSuccess: () => {
            emit('transaction-registered');
            form.reset('title', 'description', 'amount', 'category_id', 'isRecurring');
        },
    });
};

const onCategoryCreated = (newCategory) => {
    props.categories.push(newCategory);
    if (newCategory.type === form.type) {
        form.category_id = newCategory.id;
    } else {
        form.type = newCategory.type;
        form.category_id = newCategory.id;
    }
    showCategoryModal.value = false;
};
</script>
