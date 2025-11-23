<template>
    <div class="w-full bg-slate-800 rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-semibold text-white mb-6">Nova Transação</h3>

        <form @submit.prevent="store" class="flex flex-col gap-5">

            <div class="flex justify-center gap-6">
                <label class="flex items-center cursor-pointer group">
                    <input type="radio" v-model="form.type" value="income" class="sr-only peer" />
                    <div
                        class="w-4 h-4 rounded-full border-2 border-slate-500 peer-checked:bg-emerald-500 peer-checked:border-emerald-500 transition-colors">
                    </div>
                    <span
                        class="ml-2 font-medium text-slate-400 peer-checked:text-emerald-400 transition-colors">Ganho</span>
                </label>

                <label class="flex items-center cursor-pointer group">
                    <input type="radio" v-model="form.type" value="expense" class="sr-only peer" />
                    <div
                        class="w-4 h-4 rounded-full border-2 border-slate-500 peer-checked:bg-red-500 peer-checked:border-red-500 transition-colors">
                    </div>
                    <span
                        class="ml-2 font-medium text-slate-400 peer-checked:text-red-400 transition-colors">Gasto</span>
                </label>
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-slate-400 mb-1">Nome</label>
                <input type="text" id="title" v-model="form.title"
                    class="block w-full bg-slate-700/50 border border-slate-600 rounded-md py-2 px-3 text-white placeholder-slate-500 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                    placeholder="Ex: Salário" />
                <div v-if="form.errors.title" class="text-red-400 text-xs mt-1">{{ form.errors.title }}</div>
            </div>

            <div>
                <label for="descricao" class="block text-sm font-medium text-gray-300 mb-1">Descrição (Opcional)</label>
                <textarea id="descricao" v-model="form.description" rows="3"
                    class="block w-full bg-slate-700/50 border border-slate-600 rounded-md py-2 px-3 text-white placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                    placeholder="Ex: Pagamento da primeira quinzena"></textarea>
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-slate-400 mb-1">Categoria</label>
                <div class="flex items-center gap-2">
                    <div class="relative flex-grow">
                        <select id="category" v-model="form.category_id"
                            class="block w-full bg-slate-700/50 border border-slate-600 rounded-md py-2 pl-3 pr-10 text-white focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none appearance-none transition-all cursor-pointer">
                            <option :value="null" disabled>Selecione uma categoria</option>
                            <option v-for="cat in filteredCategories" :value="cat.id">{{ cat.name }}</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <button type="button" @click="showCategoryModal = true" aria-label="Adicionar Categoria"
                        class="flex-shrink-0 p-2.5 bg-slate-700 hover:bg-slate-600 border border-slate-600 rounded-md transition-colors text-slate-300 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </button>
                </div>
                <div v-if="form.errors.category_id" class="text-red-400 text-xs mt-1">{{ form.errors.category_id }}
                </div>
            </div>

            <div>
                <label for="amount" class="block text-sm font-medium text-slate-400 mb-1">Valor</label>
                <div class="relative">
                    <span class="absolute left-3 top-2 text-slate-400">R$</span>
                    <input type="number" id="amount" v-model="form.amount" step="0.01"
                        class="block w-full bg-slate-700/50 border border-slate-600 rounded-md py-2 pl-10 pr-3 text-white placeholder-slate-500 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        placeholder="0,00" />
                </div>
                <div v-if="form.errors.amount" class="text-red-400 text-xs mt-1">{{ form.errors.amount }}</div>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" id="recorrente" v-model="form.isRecurring"
                    class="h-4 w-4 rounded bg-slate-700 border-slate-600 text-yellow-500 focus:ring-yellow-500" />
                <label for="recorrente" class="text-gray-300 cursor-pointer">Recorrente</label>
            </div>

            <div v-if="form.isRecurring">
                <label for="transaction_date" class="block text-sm font-medium text-gray-300 mb-1">
                    Data da Transação
                </label>
                <input type="date" id="transaction_date" v-model="form.transaction_date" style="color-scheme: dark;"
                    class="block w-full bg-slate-700/50 border border-slate-600 rounded-md py-2 px-3 text-white focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none" />
            </div>

            <button type="submit" :disabled="form.processing"
                class="w-full bg-yellow-500 hover:bg-yellow-600 text-slate-900 font-bold py-2.5 px-4 rounded-md shadow-lg transition-all transform active:scale-[0.98]">
                Salvar
            </button>
        </form>

        <Modal v-model="showCategoryModal" title="Nova Categoria">
            <CategoryForm @success="onCategoryCreated" />
        </Modal>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '../components/Modal.vue';
import CategoryForm from '../components/CategoryForm.vue';

const emit = defineEmits(['transaction-registered']);

const props = defineProps({
    categories: Array
});

const showCategoryModal = ref(false);

const form = useForm({
    type: 'income',
    title: '',
    description: '',
    amount: '',
    category_id: null,
    isRecurring: false,
    transaction_date: new Date().toISOString().substr(0, 10),
});

const store = () => {
    form.post('/transactions', {
        onSuccess: () => {
            emit('transaction-registered');
            form.reset('title', 'description', 'amount', 'category_id', 'isRecurring');
            form.type = 'income';
        },
    });
};

const filteredCategories = computed(() => {
    return props.categories.filter(category => category.type === form.type);
});


const onCategoryCreated = (newCategory) => {

    props.categories.push(newCategory);

    form.category_id = newCategory.id;

    showCategoryModal.value = false;
};
</script>
